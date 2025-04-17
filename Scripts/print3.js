function formatDateTo12Hour(dateStr) {
    const date = new Date(dateStr);
    const options = { hour: '2-digit', minute: '2-digit', hour12: true, year: 'numeric', month: '2-digit', day: '2-digit' };
    return date.toLocaleString('en-US', options);
}

function printJobSheet(id) {
    var printWindow = window.open('', '_blank');
    printWindow.document.open();

    printWindow.document.write('<html><head><title>Job Sheet Print</title>');
    printWindow.document.write('<link rel="stylesheet" type="text/css" href="../styles/print.css">');
    printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; } th, td { border: 1px solid black; padding: 8px; }</style>');
    printWindow.document.write('</head><body>');

    fetch('../Functions/fetch_job_sheet.php?id=' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch job sheet details');
            }
            return response.json();
        })
        .then(jobSheet => {
            if (jobSheet) {
                printWindow.document.write('<div class="Frame1">');
                var img = new Image();
                img.onload = function() {
                    printWindow.document.write('<img class="StandardJobSheet16190479143" src="../image/jobsheet.png" alt="Job Sheet Image" />');
                    printWindow.document.write('<div class="Refno"></div>');
                    printWindow.document.write('<div class="Clientsinfo">');
                    printWindow.document.write('<div class="Fullname">Full Name:&emsp;&emsp;&emsp;&emsp;&emsp;' + jobSheet.full_name + '</div>');
                    printWindow.document.write('<div class="Section">Section/Division:&emsp;&emsp;&nbsp;&nbsp;' + jobSheet.section_division + '</div>');
                    printWindow.document.write('<div class="Filingdate">Date of Filing: ' + jobSheet.date_of_filing + '</div>');
                    printWindow.document.write('<div class="Contact">Contact No.: ' + jobSheet.contact_no + '</div>');
                    printWindow.document.write('<div class="Bd">Brief description of the Incident or Request:<br>' + jobSheet.description + '</div>');
                    printWindow.document.write('</div>');
                    printWindow.document.write('<div class="Techassess">');
                    printWindow.document.write('<div class="Type">Type &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp; ' + jobSheet.hardware_type + '</div>');
                    printWindow.document.write('<div class="Brand">Brand and Model &emsp;&nbsp;&nbsp;' + jobSheet.brand_model + '</div>');
                    printWindow.document.write('<div class="Serial">Serial Number: ' + jobSheet.serial_number + '</div>');
                    printWindow.document.write('<div class="Computername">Computer Name: ' + jobSheet.computer_name + '</div>');
                    printWindow.document.write('<div class="desAS">Description:</div><div class="Descriptionas"> ' + jobSheet.application_description + '</div>');
                    printWindow.document.write('<div class="Version">Version: ' + jobSheet.version + '</div>');
                    printWindow.document.write('<div class="desC">Description:</div><div class="Descriptionc"> ' + jobSheet.connectivity_description + '</div>');
                    printWindow.document.write('<div class="desU">Description:</div><div class="Descriptionua"> ' + jobSheet.user_account_description + '</div>');
                    printWindow.document.write('<div class="Assessment"><strong>Assessment:</strong> <br>' + jobSheet.assessment + '</div>');
                    printWindow.document.write('<div class="Actions"><strong>Actions Taken and/or Recommendations:</strong> <br>' + jobSheet.actions_taken + '</div>');
                    printWindow.document.write('</div>');
                    printWindow.document.write('<div class="Techassess2">');
                    
                    printWindow.document.write('<div class="Mof">Mode of Filing: </div>');

                    switch (jobSheet.mode_of_filing) {
                    case 'Walk-in':
                        printWindow.document.write('<div class="Walkin">x</div>');
                        printWindow.document.write('<div class="Telephone"></div>');
                        printWindow.document.write('<div class="Email"></div>');
                        break;
                    case 'Telephone Call':
                        printWindow.document.write('<div class="Walkin"></div>');
                        printWindow.document.write('<div class="Telephone">x</div>');
                        printWindow.document.write('<div class="Email"></div>');
                        break;
                    case 'Email':
                        printWindow.document.write('<div class="Walkin"></div>');
                        printWindow.document.write('<div class="Telephone"></div>');
                        printWindow.document.write('<div class="Email">x</div>');
                        break;
                    default:
                        break;
                    }

                    printWindow.document.write('<div class="Datr">Date and Time Received:&emsp; ' + formatDateTo12Hour(jobSheet.date_received) + '</div>');
                    printWindow.document.write('<div class="datc">Date and Time Completed:&nbsp; ' + formatDateTo12Hour(jobSheet.date_completed) + '</div>');
                    printWindow.document.write('<div class="fulfill">Fulfilled by: </div><div class="Fulfilledby">' + jobSheet.fulfilled_by + '</div>');
                    printWindow.document.write('</div>');
                    printWindow.document.write('<div class="Cevaluation">');
                    
                        switch (jobSheet.addressed) {
                        case 'Yes':
                            printWindow.document.write('<div class="Yes1">x</div>');
                            printWindow.document.write('<div class="No1"></div>');
                            break;
                        case 'No':
                            printWindow.document.write('<div class="Yes1"></div>');
                            printWindow.document.write('<div class="No1">x</div>');
                            break;
                        default:
                            break;
                        }

                        switch (jobSheet.satisfied) {
                        case 'Very Satisfied':
                            printWindow.document.write('<div class="Vs2">x</div>');
                            printWindow.document.write('<div class="S2"></div>');
                            printWindow.document.write('<div class="Ns2"></div>');
                            break;
                        case 'Satisfied':
                            printWindow.document.write('<div class="Vs2"></div>');
                            printWindow.document.write('<div class="S2">x</div>');
                            printWindow.document.write('<div class="Ns2"></div>');
                            break;
                        case 'Not Satisfied':
                            printWindow.document.write('<div class="Vs2"></div>');
                            printWindow.document.write('<div class="S2"></div>');
                            printWindow.document.write('<div class="Ns2">x</div>');
                            break;
                        default:
                            break;
                        }

                        switch (jobSheet.effective) {
                        case 'Very Satisfied':
                            printWindow.document.write('<div class="Vs3">x</div>');
                            printWindow.document.write('<div class="S3"></div>');
                            printWindow.document.write('<div class="Ns3"></div>');
                            break;
                        case 'Satisfied':
                            printWindow.document.write('<div class="Vs3"></div>');
                            printWindow.document.write('<div class="S3">x</div>');
                            printWindow.document.write('<div class="Ns3"></div>');
                            break;
                        case 'Not Satisfied':
                            printWindow.document.write('<div class="Vs3"></div>');
                            printWindow.document.write('<div class="S3"></div>');
                            printWindow.document.write('<div class="Ns3">x</div>');
                            break;
                        default:
                            break;
                        }

                    printWindow.document.write('<div class="Comments">Comments and/or Suggestions: <br>' + jobSheet.comments + '</div>');
                    printWindow.document.write('</div>');
                    printWindow.document.write('</div>');

                    printWindow.document.write('</body></html>');
                    printWindow.document.close();

                    printWindow.print();
                };
                img.onerror = function() {
                    console.error('Failed to load image');
                    printWindow.document.write('<div>Failed to load image</div>');
                    printWindow.document.close();
                };
                img.src = '../image/jobsheet.png'; 
            } else {
                alert('Error: Job sheet not found.');
                printWindow.document.close();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error: Failed to fetch job sheet details.');
            printWindow.document.close();
        });

    return false;
}

function printPage() {
    var table = document.querySelector('table');

    var rows = table.querySelectorAll('tbody tr');

    var printContent = '<table border="1" style="border-collapse: collapse; width: 100%; font-family:arial;"><thead>' +
                    '<tr><th>Item No.</th><th>Type of Incident</th><th>Main Category</th><th>Sub-Category</th><th>Description of Incident</th><th>Status</th>' +
                    '<th>Date Reported<br>(mm/dd/yyyy)</th><th>Reported by</th><th>Resolution/Remarks</th></tr></thead><tbody>';

    var itemNumber = 1;

    rows.forEach(function(row) {
        var rowData = {
            incident_type: row.cells[21].innerText,
            type: row.cells[5].innerText,
            hardware_type: row.cells[6].innerText,
            application_description: row.cells[10].innerText,
            description: row.cells[2].innerText,
            status: row.cells[22].innerText,
            date_of_filing: formatDateTo12Hour(row.cells[3].innerText),
            full_name: row.cells[0].innerText,
            actions_taken: row.cells[15].innerText
        };

        var subCategory = '';
        if (rowData.hardware_type.trim() === 'N/A') {
            if (rowData.application_description.trim() !== 'N/A') {
                subCategory = rowData.application_description;
            }
        } else {
            if (rowData.application_description.trim() !== '' && rowData.application_description.trim() !== 'N/A') {
                subCategory = rowData.hardware_type + ', ' + rowData.application_description;
            } else {
                subCategory = rowData.hardware_type;
            }
        }

        printContent += '<tr>';
        printContent += '<td>' + itemNumber++ + '</td>';
        printContent += '<td>' + rowData.incident_type + '</td>';
        printContent += '<td>' + rowData.type + '</td>';
        printContent += '<td>' + subCategory + '</td>';
        printContent += '<td>' + rowData.description + '</td>';
        printContent += '<td>' + rowData.status + '</td>';
        printContent += '<td>' + formatDateTo12Hour(rowData.date_of_filing) + '</td>';
        printContent += '<td>' + rowData.full_name + '</td>';
        printContent += '<td>' + rowData.actions_taken + '</td>';
        printContent += '</tr>';
    });

    printContent += '</tbody></table>';

    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Incident Report Print</title>');
    printWindow.document.write('<link rel="stylesheet" type="text/css" href="../styles/print.css">');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h1>Incident Report</h1>');
    printWindow.document.write(printContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    printWindow.print();
}
