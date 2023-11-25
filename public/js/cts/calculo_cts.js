//CALCULOS PARA CUANDO INGRESE MANUALMENTE 1/6 de GRATIFICACION
const editableCells = document.querySelectorAll('.editable-cell');

    editableCells.forEach((cell) => {
        cell.addEventListener('input', handleCellValueChange);
    });

    function handleCellValueChange(event) {
        const currentCell = event.target;
        const row = currentCell.parentNode;
        const sumaRemuneracionesCell = row.querySelector('.suma-remuneraciones');
        const baseCalculo = row.querySelector('.base-calculo');
        const factorCalculo = row.querySelector('.factor-calculo');

        const sumaRemuneraciones = parseFloat(sumaRemuneracionesCell.textContent) || 0;
        const inputValue = parseFloat(currentCell.textContent) || 0;

        const nuevaSuma = sumaRemuneraciones + inputValue;
        const factor = nuevaSuma * 0.08333;

        if (isNaN(nuevaSuma)) {
            baseCalculo.textContent = '';
            factorCalculo.textContent = '';
        } else {
            baseCalculo.textContent = nuevaSuma.toFixed(2);
            factorCalculo.textContent = factor.toFixed(2);
        }
    }

    //EXPORTAR TABLA EN EXCEL
    document.getElementById('exportarExcelBtn').addEventListener('click', function () {
        var elt = document.getElementById("tablaCTS");
    
        var workbook = new ExcelJS.Workbook();
        var worksheet = workbook.addWorksheet("Pedidos");
    
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
    
        dataArray.forEach(function(rowData, rowIndex) {
          var row = worksheet.addRow([]);
          rowData.forEach(function(cellData, columnIndex) {
            var cell = row.getCell(row.cellCount + 1);
            cell.value = cellData.value;
    
            cell.border = {
              top: { style: "thin" },
              left: { style: "thin" },
              bottom: { style: "thin" },
              right: { style: "thin" }
            };
            cell.alignment = { vertical: "middle", horizontal: "center" };
            cell.font = { bold: true };
    
            if (rowIndex === 0) {
              cell.fill = {
                type: "pattern",
                pattern: "solid",
                fgColor: { argb: "0000FF" } // Color de fondo azul (#0000FF)
              };
              cell.font.color = { argb: "FFFFFF" }; // Color de letra blanco (#FFFFFF)
            }
    
            if (cellData.value && (columnIndex === 10)) {
              cell.fill = {
                type: "pattern",
                pattern: "solid",
                fgColor: { argb: "FFFFCC" } // Color de fondo amarillo claro (#FFFFCC)
              };
            }
    
            if (cellData.colspan > 1) {
              worksheet.mergeCells(
                cell.address + ":" + worksheet.getCell(row.number, row.cellCount + cellData.colspan - 1).address
              );
            }
          });
        });
    
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
          column.width = maxLength + 2; // Ajusta el ancho de acuerdo a la longitud del contenido
        });
    
        workbook.xlsx.writeBuffer().then(function(buffer) {
          var blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
          var url = URL.createObjectURL(blob);
          var link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", "cts_calculo_jp.xlsx");
          link.click();
        });
      });