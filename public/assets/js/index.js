const menuLi = document.querySelectorAll(".admin-sidebar-content ul li");

menuLi.forEach(li => {
    li.addEventListener('click', (e) => {
        // e.preventDefault(); // Loại bỏ hoặc bình luận dòng này nếu không cần ngăn hành động mặc định
        const subMenu = li.querySelector('.sub-menu');
        if (subMenu) {
            subMenu.classList.toggle('active');
        }
    });
});
