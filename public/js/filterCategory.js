function filterByCategory(categoryId) {
    fetch(`/filter-category/${categoryId}`)
        .then(response => response.json())
        .then(data => {
            const storyContainer = document.querySelector('.row.g-4');
            storyContainer.innerHTML = ''; // Xóa nội dung cũ
            data.posts.forEach(post => {
                const storyItem = `
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="story-item h-100 d-flex flex-column">
                            <a href="story/${post.id}" class="d-block text-decoration-none h-100">
                                <div class="story-item__image mb-3">
                                    <img src="${post.anhgioithieu}" 
                                         alt="${post.tentruyen}" 
                                         class="img-fluid w-100" 
                                         style="height: 250px; object-fit: cover;" 
                                         loading="lazy">
                                </div>
                                <h3 class="story-item__name text-truncate">${post.tentruyen}</h3>
                            </a>
                        </div>
                    </div>`;
                storyContainer.innerHTML += storyItem;
            });
        })
        .catch(error => console.error('Lỗi khi lấy dữ liệu:', error));
}
