function fnExportToExcel(fileExtension, fileName) {
    var elt = document.getElementById("tablaPlanilla");

    // Crear un nuevo libro de Excel
    var workbook = new ExcelJS.Workbook();
    var worksheet = workbook.addWorksheet("Planilla");

    // Establecer estilos para el encabezado y td número 10, 31 y 42
    var headerStyle = {
      fill: {
        type: "pattern",
        pattern: "solid",
        fgColor: { argb: "0000FF" } // Color de fondo azul (#0000FF)
      },
      font: {
        color: { argb: "FFFFFF" }, // Color de letra blanco (#FFFFFF)
        bold: true
      }
    };

    var td31And10And42Style = {
      fill: {
        type: "pattern",
        pattern: "solid",
        fgColor: { argb: "FFFFCC" } // Color de fondo amarillo claro (#FFFFCC)
      }
    };

    // Obtener los datos de la tabla como una matriz de cadenas de texto
    var dataArray = [];
    var rows = elt.querySelectorAll("tr");
    rows.forEach(function(row) {
      var rowData = [];
      var cells = row.querySelectorAll("th, td");
      cells.forEach(function(cell) {
        var value = cell.textContent.trim();
        var colspan = parseInt(cell.getAttribute("colspan")) || 1;
        rowData.push({ value: value, colspan: colspan });
      });
      dataArray.push(rowData);
    });

    // Agregar los datos a la hoja de cálculo y aplicar estilos al encabezado y td número 10, 31 y 42
    dataArray.forEach(function(rowData, rowIndex) {
      var row = worksheet.addRow([]);
      rowData.forEach(function(cellData, columnIndex) {
        var cell = row.getCell(row.cellCount + 1);
        cell.value = cellData.value;

        if (rowIndex === 0) {
          // Establecer estilo para el primer tr (encabezado completo)
          cell.fill = headerStyle.fill;
          cell.font = headerStyle.font;
        } 

        cell.border = {
          top: { style: "thin" },
          left: { style: "thin" },
          bottom: { style: "thin" },
          right: { style: "thin" }
        };
        cell.alignment = { vertical: "middle", horizontal: "center" };
        cell.font = { bold: true };

        // Fusionar celdas según colspan
        if (cellData.colspan > 1) {
          worksheet.mergeCells(
            cell.address + ":" + worksheet.getCell(row.number, row.cellCount + cellData.colspan - 1).address
          );
        }
      });
    });

    // Ajustar el ancho de las columnas según el contenido de las celdas de la primera fila
    var headerRow = dataArray[0];
    headerRow.forEach(function(cellData, columnIndex) {
      var column = worksheet.getColumn(columnIndex + 1);
      var maxLength = 0;
      dataArray.forEach(function(rowData) {
        var cell = rowData[columnIndex];
        if (cell && cell.value) {
          var length = cell.value.toString().length;
          maxLength = Math.max(maxLength, length);
        }
      });
      column.width = Math.min(40, Math.max(12, maxLength + 2)) + 8; // Agregar 2 centímetros adicionales al ancho calculado
    });

    // Descargar el archivo Excel
    workbook.xlsx.writeBuffer().then(function(buffer) {
      var blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
      var url = URL.createObjectURL(blob);
      var link = document.createElement("a");
      link.href = url;
      link.setAttribute("download", fileName + "." + fileExtension || "MySheetName." + (fileExtension || "xlsx"));
      link.click();
    });
  }