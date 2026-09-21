async function loadTable(jsonFile, keys, showDetail) {
  const tbody = document.querySelector(".table-responsive table tbody");
  const loading = document.getElementById("loading-indicator");
  if (!tbody) return;

  loading.style.display = "block";
  tbody.innerHTML = "";

  try {
    await new Promise((resolve) => setTimeout(resolve, 600));

    const res = await fetch(jsonFile);
    if (!res.ok) {
      throw new Error("Failed to fetch data (status " + res.status + ")");
    }

    const data = await res.json();

    data.forEach(function (item) {
      const tr = document.createElement("tr");
      let html = "";
      keys.forEach(function (key) {
        html += "<td>" + item[key] + "</td>";
      });
      html +=
        "<td>" +
        '<button type="button">Edit</button> ' +
        (showDetail ? '<button type="button">Detail</button> ' : "") +
        '<button type="button" class="btn-delete">Delete</button>' +
        "</td>";
      tr.innerHTML = html;
      tbody.appendChild(tr);
    });
  } catch (err) {
    tbody.innerHTML =
      '<tr><td colspan="' + (keys.length + 1) + '">Failed to load data: ' + err.message + "</td></tr>";
  } finally {
    loading.style.display = "none";
  }
}