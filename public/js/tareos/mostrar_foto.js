function setIframeSrc(url) {
    const iframe = document.getElementById('pdfIframe');

    iframe.src = url;
}

function zoomIn() {
    var iframe = document.getElementById("pdfIframe");
    iframe.contentDocument.body.style.zoom = "150%"; // Ajusta el valor del zoom según tus necesidades
  }
  
  function zoomOut() {
    var iframe = document.getElementById("pdfIframe");
    iframe.contentDocument.body.style.zoom = "100%"; // Ajusta el valor del zoom según tus necesidades
  }