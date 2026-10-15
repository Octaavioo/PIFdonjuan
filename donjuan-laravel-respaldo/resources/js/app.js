window.toggleTheme = function (mode) {
    const root = document.documentElement;
    const light = mode === 'light';

    root.classList.toggle('light-theme', light);
    localStorage.setItem('donjuan-theme', light ? 'light' : 'dark');

    document.querySelectorAll('[data-theme-dark]').forEach(button => {
        button.classList.toggle('active', !light);
    });
    document.querySelectorAll('[data-theme-light]').forEach(button => {
        button.classList.toggle('active', light);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    const saved = localStorage.getItem('donjuan-theme') || 'dark';
    window.toggleTheme(saved);
});
