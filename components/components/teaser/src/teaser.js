(() => {
  document.querySelectorAll(".c-recipe-teaser--card").forEach(card => {
    const img = card.querySelector("img");
    if (img) {
      card.style.setProperty("--teaser-bg-image", `url(${img.src})`);
    }
  });
})();