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
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initNeuroAprender, { once: true });
  } else {
    initNeuroAprender();
  }
})();
