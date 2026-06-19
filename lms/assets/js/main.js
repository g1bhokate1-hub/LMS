function openTab(tabId) {
    let tabs = document.querySelectorAll(".tab-content");
    let buttons = document.querySelectorAll(".tab-btn");

    // Hide all tabs
    tabs.forEach(tab => {
        tab.classList.remove("active-tab");
    });

    // Remove active button style
    buttons.forEach(btn => {
        btn.classList.remove("active");
    });

    // Show selected tab
    let selectedTab = document.getElementById(tabId);
    if (selectedTab) {
        selectedTab.classList.add("active-tab");
    }

    // Highlight clicked button without using event
    let activeBtn = document.querySelector(`[onclick="openTab('${tabId}')"]`);
    if (activeBtn) {
        activeBtn.classList.add("active");
    }
}

function addSubjectRow() {
    let table = document.getElementById("subjects-table");

    let row = table.insertRow(-1);

    row.innerHTML = `
        <td>650</td>
        <td>#</td>
        <td>0</td>
        <td>a</td>
        <td>Topical Term</td>
        <td><input type="text" placeholder="Enter Subject"></td>
    `;
}