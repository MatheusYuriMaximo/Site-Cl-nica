(() => {
  if (window.__neuroaprenderSiteReady) return;
  window.__neuroaprenderSiteReady = true;

  const initNeuroAprender = () => {
    const menuToggle = document.querySelector(".menu-toggle");
    const siteNav = document.querySelector(".site-nav");

    if (menuToggle && siteNav) {
      menuToggle.addEventListener("click", () => {
        const isOpen = siteNav.classList.toggle("is-open");
        menuToggle.setAttribute("aria-expanded", String(isOpen));
        document.body.classList.toggle("nav-open", isOpen);
      });

      siteNav.addEventListener("click", (event) => {
        if (event.target instanceof HTMLAnchorElement) {
          siteNav.classList.remove("is-open");
          menuToggle.setAttribute("aria-expanded", "false");
          document.body.classList.remove("nav-open");
        }
      });
    }

    document.querySelectorAll(".gallery-shell").forEach((gallery) => {
      const track = gallery.querySelector(".gallery-track");
      const prev = gallery.querySelector(".gallery-prev");
      const next = gallery.querySelector(".gallery-next");

      if (!track || !prev || !next) return;

      const updateControls = () => {
        const maxScroll = track.scrollWidth - track.clientWidth;
        prev.disabled = track.scrollLeft <= 4;
        next.disabled = track.scrollLeft >= maxScroll - 4;
      };

      const scrollGallery = (direction) => {
        track.scrollBy({
          left: direction * Math.max(280, track.clientWidth * 0.82),
          behavior: "smooth",
        });
      };

      prev.addEventListener("click", () => scrollGallery(-1));
      next.addEventListener("click", () => scrollGallery(1));
      track.addEventListener("scroll", updateControls, { passive: true });
      window.addEventListener("resize", updateControls);
      updateControls();
    });

    const lightbox = document.querySelector("#photo-lightbox");
    const lightboxImage = lightbox?.querySelector("img");
    const lightboxClose = lightbox?.querySelector(".lightbox-close");
    const lightboxPrev = lightbox?.querySelector(".lightbox-prev");
    const lightboxNext = lightbox?.querySelector(".lightbox-next");
    const galleryImages = Array.from(document.querySelectorAll(".gallery-track img"));
    let activePhotoIndex = 0;

    const showPhoto = (index) => {
      if (!lightbox || !lightboxImage || galleryImages.length === 0) return;

      activePhotoIndex = (index + galleryImages.length) % galleryImages.length;
      const photo = galleryImages[activePhotoIndex];
      lightboxImage.src = photo.currentSrc || photo.src;
      lightboxImage.alt = photo.alt || "Foto ampliada";
      lightbox.hidden = false;
      document.body.classList.add("lightbox-open");
      lightboxClose?.focus();
    };

    const closePhoto = () => {
      if (!lightbox || !lightboxImage) return;

      lightbox.hidden = true;
      lightboxImage.src = "";
      document.body.classList.remove("lightbox-open");
    };

    galleryImages.forEach((photo, index) => {
      photo.tabIndex = 0;
      photo.setAttribute("role", "button");
      photo.addEventListener("click", () => showPhoto(index));
      photo.addEventListener("keydown", (event) => {
        if (event.key === "Enter" || event.key === " ") {
          event.preventDefault();
          showPhoto(index);
        }
      });
    });

    lightboxClose?.addEventListener("click", closePhoto);
    lightboxPrev?.addEventListener("click", () => showPhoto(activePhotoIndex - 1));
    lightboxNext?.addEventListener("click", () => showPhoto(activePhotoIndex + 1));

    lightbox?.addEventListener("click", (event) => {
      if (event.target === lightbox) closePhoto();
    });

    document.addEventListener("keydown", (event) => {
      if (!lightbox || lightbox.hidden) return;

      if (event.key === "Escape") closePhoto();
      if (event.key === "ArrowLeft") showPhoto(activePhotoIndex - 1);
      if (event.key === "ArrowRight") showPhoto(activePhotoIndex + 1);
    });

    const chat = document.querySelector(".ai-chat");
    const chatToggle = chat?.querySelector(".ai-chat-toggle");
    const chatPanel = chat?.querySelector(".ai-chat-panel");
    const chatClose = chat?.querySelector(".ai-chat-close");
    const chatForm = chat?.querySelector(".ai-chat-form");
    const chatInput = chat?.querySelector("textarea");
    const chatMessages = chat?.querySelector(".ai-chat-messages");
    const chatConfig = window.NeuroAprenderChat || {};
    const chatHistory = [];

    const addChatMessage = (content, type = "bot") => {
      if (!chatMessages) return null;

      const message = document.createElement("div");
      message.className = `ai-message ai-message-${type}`;
      message.textContent = content;
      chatMessages.appendChild(message);
      chatMessages.scrollTop = chatMessages.scrollHeight;
      return message;
    };

    const setChatOpen = (isOpen) => {
      if (!chatPanel || !chatToggle) return;

      chatPanel.hidden = !isOpen;
      chatToggle.setAttribute("aria-expanded", String(isOpen));
      chat?.classList.toggle("is-open", isOpen);

      if (isOpen) {
        setTimeout(() => chatInput?.focus(), 50);
      }
    };

    chatToggle?.addEventListener("click", () => {
      setChatOpen(Boolean(chatPanel?.hidden));
    });

    chatClose?.addEventListener("click", () => setChatOpen(false));

    chatForm?.addEventListener("submit", async (event) => {
      event.preventDefault();

      if (!chatInput || !chatConfig.endpoint) return;

      const text = chatInput.value.trim();
      if (!text) return;

      chatInput.value = "";
      chatInput.disabled = true;
      addChatMessage(text, "user");
      const pending = addChatMessage("Digitando...", "bot");

      try {
        const response = await fetch(chatConfig.endpoint, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            message: text,
            history: chatHistory.slice(-6),
          }),
        });

        const data = await response.json().catch(() => ({}));
        const answer = data.message || chatConfig.errorMessage || "Não consegui responder agora.";

        if (pending) pending.textContent = answer;
        chatHistory.push({ role: "user", content: text });
        chatHistory.push({ role: "assistant", content: answer });
      } catch (error) {
        if (pending) {
          pending.textContent = chatConfig.errorMessage || "Não consegui responder agora. Você pode chamar a equipe pelo WhatsApp.";
        }
      } finally {
        chatInput.disabled = false;
        chatInput.focus();
      }
    });
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initNeuroAprender, { once: true });
  } else {
    initNeuroAprender();
  }
})();
