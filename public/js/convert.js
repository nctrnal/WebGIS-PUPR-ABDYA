document.getElementById("convert").addEventListener("click", async () => {
  const geojsonId = document.getElementById("json").value;

  // Kirim data ID GeoJSON ke server
  const response = await fetch("/convert-and-download", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "geojson_id=" + encodeURIComponent(geojsonId),
  });

  // Menerima file Shapefile dari server dan mengunduhnya
  const blob = await response.blob();
  const link = document.createElement("a");
  link.href = window.URL.createObjectURL(blob);
  link.download = "converted_shapefile.zip";
  link.click();
});
