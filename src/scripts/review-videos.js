import forEach from "lodash/forEach";

// Превью Rutube-видео подтягиваются на клиенте: ручное превью (video_thumbnail)
// имеет приоритет и рендерится сразу, остальным URL собирает этот модуль.
export function initReviewVideos() {
  forEach(document.querySelectorAll("img[data-rutube-thumb]"), (img) => {
    const id = img.dataset.rutubeThumb;
    if (!id || img.dataset.rutubeThumbLoaded) return;
    img.dataset.rutubeThumbLoaded = "1";

    fetch("https://rutube.ru/api/video/" + id + "/")
      .then((response) => (response.ok ? response.json() : null))
      .then((data) => {
        if (data && data.thumbnail_url) {
          img.src = data.thumbnail_url;
        }
      })
      .catch(() => {
        // Остается плейсхолдер с кнопкой play — плеер в модалке работает в любом случае.
      });
  });
}
