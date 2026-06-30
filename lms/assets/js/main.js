function openTab(tabId) {
    // 1. Hide all tab view panels
    const layers = document.querySelectorAll('.tab-content');
    layers.forEach(layer => {
        layer.classList.remove('active-tab');
    });

    // 2. Clear out active highlights on buttons
    const buttons = document.querySelectorAll('.tab-btn');
    buttons.forEach(btn => {
        btn.classList.remove('active');
    });

    // 3. Mount active class to targeted layer
    const activeTarget = document.getElementById(tabId);
    if (activeTarget) {
        activeTarget.classList.add('active-tab');
    }

    // 4. Highlight current clicking button
    if (event && event.currentTarget) {
        event.currentTarget.classList.add('active');
    }
}