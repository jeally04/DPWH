function printPage() {
    var region = document.getElementById('region').value;
    var office = document.getElementById('office').value;
    var address = document.getElementById('address').value;
    var officers = document.getElementById('officers').value;
    var contact = document.getElementById('contact').value;
    var email = document.getElementById('email').value;
    var submitted = document.getElementById('submitted').value;
    var noted = document.getElementById('noted').value;
    
    const monthInput = document.querySelector('input[name="month"]').value;
    const [month, year] = monthInput ? monthInput.split(', ') : [new Date().toLocaleString('default', { month: 'long' }), new Date().getFullYear()];

    var printContent = `
        <div style="text-align: left; font-family: Arial; font-size: 12px;">
        <h3 style="margin-bottom: 1px; margin-top: 10px;">Monthly Help Desk Report</h3>
        <div style="margin-top: 1px;">For the Month of <span style="border-bottom: 1px solid #000; display: inline-block; min-width: 244px;">${month}, ${year}</span></div>
        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            <div style="flex: 1;">
                <div style="margin-bottom: 1px;">Region: <span style="border-bottom: 1px solid #000; margin-left: 27px; display: inline-block; min-width: 280px;">${region}</span></div>
                <div style="margin-bottom: 1px;">Office: <span style="border-bottom: 1px solid #000; margin-left: 34px; display: inline-block; min-width: 280px;">${office}</span></div>
                <div>Address: <span style="border-bottom: 1px solid #000; margin-left: 21px; display: inline-block; min-width: 280px;">${address}</span></div>
            </div>
            <div style="flex: 1; text-align: right;">
                <div style="margin-bottom: 1px;">IT Support Officers: <span style="border-bottom: 1px solid #000; text-align: left; margin-left: 24px; display: inline-block; width: 50%; min-width: 350px;">${officers}</span></div>
                <div style="margin-bottom: 1px;">Contact Number: <span style="border-bottom: 1px solid #000; display: inline-block; text-align: left; margin-left: 24px; width: auto; min-width: 350px;">${contact}</span></div>
                <div>Email Address: <span style="border-bottom: 1px solid #000; display: inline-block; margin-left: 24px; width: 50%; text-align: left; min-width: 350px; color: blue;">${email}</span></div>
            </div>
        </div>
    </div>
    `;

    var table = document.getElementById('reportTable');
    var rows = table.querySelectorAll('tbody tr');

    printContent += '<table border="1" style="border-collapse: collapse; width: 100%; margin-top: 20px; font-family: Arial; font-size: 12px;">' +
                    '<thead style="text-align: center; white-space: nowrap;">' + 
                    '<tr style="padding: 15px;">' +
                    '<th style="padding: 15px;">Item No.</th>' +
                    '<th style="padding: 15px;">Type of Incident</th>' +
                    '<th style="padding: 15px;">Main Category</th>' +
                    '<th style="padding: 15px;">Sub-Category</th>' +
                    '<th style="padding: 15px;">Description of Incident</th>' +
                    '<th style="padding: 15px;">Status</th>' +
                    '<th style="padding: 15px;">Date Reported <br>(mm/dd/yyyy)</th>' +
                    '<th style="padding-left: 20px; padding-right: 20px;">Reported by</th>' +
                    '<th style="padding-left: 20px; padding-right: 20px;">Resolution/Remarks</th>' +
                    '</tr>' +
                    '</thead><tbody>';

    rows.forEach(function(row) {
        var rowData = {
            incident_type: row.cells[1].innerText,
            type: row.cells[2].innerText,
            hardware_type: row.cells[3].innerText,
            description: row.cells[4].innerText,
            status: row.cells[5].innerText,
            date_of_filing: row.cells[6].innerText,
            full_name: row.cells[7].innerText,
            actions_taken: row.cells[8].innerText
        };

        printContent += '<tr style="height: auto; min-height: 50px;">' +
                '<td style="padding: 10px; text-align: center; vertical-align: middle; height: 50px;">' + row.cells[0].innerText + '</td>' +
                '<td style="padding: 10px; text-align: center; white-space: nowrap; vertical-align: middle; height: 50px;">' + rowData.incident_type + '</td>' +
                '<td style="padding: 10px; vertical-align: middle; height: 50px;">' + rowData.type + '</td>' +
                '<td style="padding: 10px; text-align: center; vertical-align: middle; height: 50px;">' + rowData.hardware_type + '</td>' +
                '<td style="padding: 10px; vertical-align: middle; height: 50px;">' + rowData.description + '</td>' +
                '<td style="padding: 10px; vertical-align: middle; height: 50px;">' + rowData.status + '</td>' +
                '<td style="padding: 10px; text-align: center; vertical-align: middle; height: 50px;">' + rowData.date_of_filing + '</td>' +
                '<td style="padding: 10px; white-space: nowrap; vertical-align: middle; height: 50px;">' + rowData.full_name + '</td>' +
                '<td style="padding: 10px; vertical-align: middle; height: 50px;">' + rowData.actions_taken + '</td>' +
                '</tr>';
    });

    printContent += '</tbody></table>';

    printContent += '<div class="signatures">' +
                    '<div class="prepared">' +
                    '<div class="SubmittedBy">Prepared & Submitted by:</div>' +
                    '<div class="ItSupportOfficer">' + submitted + '</div>' +
                    '<div class="DistrictIT">District IT Support Officer</div>' +
                    '<div class="SignatureOverPrintedName">(Signature over printed name)</div>' +
                    '</div>' +
                    '<div class="noted">' +
                    '<div class="NotedBy">Noted by:</div>' +
                    '<div class="OicDistrictEngineer">' + noted + '</div>' +
                    '<div class="OIC">OIC - District Engineer</div>' +
                    '<div class="SignatureOverPrintedName">(Signature over printed name)</div>' +
                    '</div>' +
                    '</div>';

    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>Monthly Help Desk Report</title></head><body>');
    printWindow.document.write(`
        <style>
            body {
                font-size: 12px;
            }
            .signatures {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }
            .prepared {
                text-align: left;
                width: 45%; 
                margin-bottom: 20px;
                font-family: Arial;
                page-break-inside: avoid;
            }
            .noted {
                text-align: left;
                width: 40%;
                margin-bottom: 20px;
                font-family: Arial;
                page-break-inside: avoid;
            }
            .prepared div, .noted div {
                margin-bottom: 10px;
            }
            .SignatureOverPrintedName {
                text-align: center;
                margin-top: -10px;
            }
            .ItSupportOfficer, .OicDistrictEngineer {
                text-align: center;
                font-family: Arial;
                font-weight: bold;
                text-transform: uppercase;
            }
            .ItSupportOfficer, .OicDistrictEngineer {
                margin-top: 70px; /* Adjust spacing if needed */
                border-bottom: 1px solid black; /* Adds the underline */
                width: 50%; /* Make the underline wider */
                right: 75%;
                left: 25%;
                padding-bottom: 3px; /* Adjust padding as needed */
                position: relative; /* Required for pseudo-element positioning */
            }
            .DistrictIT, .OIC {
                margin-top: 5px;
                text-align: center;
                padding-bottom: 5px; /* Adjust padding as needed */
                position: relative;
            }
            table tbody tr {
                min-height: 50px;
                height: auto;
                overflow: hidden;
            }
            table tbody tr td {
                vertical-align: middle; /* Vertically center align text */
                padding: 10px; /* Add padding for spacing */
            }
            @media print {
                tr, td, th { page-break-inside: avoid; }
                thead { display: table-header-group; }
                tfoot { display: table-footer-group; }
                .signatures { page-break-inside: avoid; }
            }
            .SubmittedBy {
                margin-bottom: -20px;
            }
            .NotedBy {
                margin-bottom: -50px;
                margin-left: 50px;
            }
        </style>
    `);
    printWindow.document.write(printContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    printWindow.print();
}
