<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item">Reminder</li>
			  <li class="breadcrumb-item active">Detail</li>				  
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Verification Form</h2>

            <form action="/report/store" method="post">
                @csrf

                {{-- Rec'D Date --}}
                <div class="mb-3">
                    <label for="Rec_Date" class="form-label">Rec'D Date:</label>
                    <input type="date" id="Rec_Date" name="Rec_Date" class="form-control" required>
                </div>

                {{-- Verify Date --}}
                <div class="mb-3">
                    <label for="Verify_Date" class="form-label">Verify Date:</label>
                    <input type="date" id="Verify_Date" name="Verify_Date" class="form-control" required>
                </div>

                {{-- Customer --}}
                <div class="mb-3">
                    <label for="Customer" class="form-label">Customer:</label>
                    <input type="text" id="Customer" name="Customer" class="form-control" required>
                </div>

                {{-- Invoice No --}}
                <div class="mb-3">
                    <label for="Invoice_No" class="form-label">Invoice No:</label>
                    <input type="text" id="Invoice_No" name="Invoice_No" class="form-control" required>
                </div>

                {{-- Number of Parts --}}
                <div class="mb-3">
                    <label for="num_of_parts" class="form-label">Number of Parts:</label>
                    <input type="number" id="num_of_parts" name="num_of_parts" class="form-control" min="1" required>
                </div>

                <!-- {{-- Customer Defect Detail --}}
                <div class="mb-3">
                    <label for="customer_defect_details" class="form-label">Number of Customer Defect Details:</label>
                    <input type="number" id="customer_defect_details" name="customer_defect_details" class="form-control" min="0">
                </div>

                {{-- Daijo Defect Detail --}}
                <div class="mb-3">
                    <label for="daijo_defect_details" class="form-label">Number of Daijo Defect Details:</label>
                    <input type="number" id="daijo_defect_details" name="daijo_defect_details" class="form-control" min="0">
                </div> -->

                {{-- Part Details --}}
                <div id="partDetails" class="mb-3 row">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional, if you need JavaScript features) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('num_of_parts').addEventListener('input', updatePartDetails);
        // document.getElementById('customer_defect_details').addEventListener('input', updateDefectDetailFields);
        // document.getElementById('daijo_defect_details').addEventListener('input', updateDefectDetailFields);
    });

    function updatePartDetails() {
        const numParts = document.getElementById('num_of_parts').value;
        const partDetails = document.getElementById('partDetails');

        // Clear existing details
        partDetails.innerHTML = '';

        // Create details for each part
        for (let i = 1; i <= numParts; i++) {
            createPartDetails(i);
        }
    }

    function createPartDetails(partNumber) {
        const partDetails = document.getElementById('partDetails');

        // Create container for part details
        const partDetailContainer = document.createElement('div');
        partDetailContainer.classList.add('col-md-4', 'mb-3');

        // Add part number label
        const partNumberLabel = document.createElement('label');
        partNumberLabel.textContent = `Part ${partNumber} Details:`;
        partNumberLabel.classList.add('form-label', 'mb-2', 'text-primary', 'fw-bold');
        partDetailContainer.appendChild(partNumberLabel);

        // Add part name input
        createInput(partDetailContainer, `Part ${partNumber} Name:`, `part_names[${partNumber}]`, 'text');

        // Add details for the new part
        addPartDetails(partDetailContainer, partNumber);

        // Append to the main container
        partDetails.appendChild(partDetailContainer);

        // Show the details for the first part by default
        if (partNumber === 1) {
            showDetails(partNumber);
        }
    }

    function addPartDetails(container, partNumber) {
        // Add detail inputs
        createInput(container, `Rec'D Quantity:`, `rec_quantity[${partNumber}]`, 'number');
        createInput(container, `Verify Quantity:`, `verify_quantity[${partNumber}]`, 'number');
        createInput(container, `Production Date:`, `prod_date[${partNumber}]`, 'date');
        createInput(container, `Shift:`, `shift[${partNumber}]`, 'number');
        createInput(container, `Can Use:`, `can_use[${partNumber}]`, 'number');
        createInput(container, `Customer Defect:`, `customer_defect[${partNumber}]`, 'number');
        createInput(container, `Daijo Defect:`, `daijo_defect[${partNumber}]`, 'number');
        for(i = 1; i<= 10; i++)
        {
            createInput(container, `Customer Defect Detail ${i} :`, `customer_defect_detail[${partNumber}][${i}]`, 'text');
            createInput(container, `Customer Remark ${i} :`, `customer_Remark[${partNumber}][${i}]`, 'text');
        }

        for(i = 1; i<= 10; i++)
        {
            createInput(container, `Daijo Defect Detail ${i} :`, `daijo_defect_detail[${partNumber}][${i}]`, 'text');
            createInput(container, `Daijo Remark ${i} :`, `daijo_Remark[${partNumber}][${i}]`, 'text');
        }

        // // Add defect detail inputs dynamically
        // const numCustomerDefectDetails = document.getElementById('customer_defect_details').value;
        // const numDaijoDefectDetails = document.getElementById('daijo_defect_details').value;

        // createDefectDetailFields(container, partNumber, numCustomerDefectDetails, 'Customer Defect Detail');
        // createDefectDetailFields(container, partNumber, numDaijoDefectDetails, 'Daijo Defect Detail');
    }

    function createDefectDetailFields(container, partNumber, numDefectDetails, label) {
        for (let i = 1; i <= numDefectDetails; i++) {
            createInput(container, `${label} ${i}:`, `defect_details[${partNumber}][${label.toLowerCase().replace(/\s+/g, '_')}_${i}]`, 'text');
            createInput(container, `Action ${i}:`, `defect_details[${partNumber}][action_${label.toLowerCase().replace(/\s+/g, '_')}_${i}]`, 'text');
        }
    }

    function updateDefectDetailFields() {
        const numCustomerDefectDetails = document.getElementById('customer_defect_details').value;
        const numDaijoDefectDetails = document.getElementById('daijo_defect_details').value;

        // Update defect detail fields for each part
        const numParts = document.getElementById('num_of_parts').value;
        for (let i = 1; i <= numParts; i++) {
            const partDetailContainer = document.getElementById(`partDetails`).children[i - 1];
            updateDefectDetailFieldsForPart(partDetailContainer, i, numCustomerDefectDetails, 'Customer Defect Detail');
            updateDefectDetailFieldsForPart(partDetailContainer, i, numDaijoDefectDetails, 'Daijo Defect Detail');
        }
    }

    function updateDefectDetailFieldsForPart(container, partNumber, numDefectDetails, label) {
        // Remove existing defect detail fields
        for (let i = 1; i <= numDefectDetails; i++) {
            const defectDetailInput = document.querySelector(`[name="defect_details[${partNumber}][${label.toLowerCase().replace(/\s+/g, '_')}_${i}]"]`);
            const actionInput = document.querySelector(`[name="defect_details[${partNumber}][action_${label.toLowerCase().replace(/\s+/g, '_')}_${i}]"]`);
            if (defectDetailInput) {
                container.removeChild(defectDetailInput.parentNode);
            }
            if (actionInput) {
                container.removeChild(actionInput.parentNode);
            }
        }

        // Add new defect detail fields
        createDefectDetailFields(container, partNumber, numDefectDetails, label);
    }

    function createInput(container, labelText, name, type) {
        const div = document.createElement('div');
        div.classList.add('mb-3');

        const label = document.createElement('label');
        label.textContent = labelText;
        label.classList.add('form-label');

        const input = document.createElement('input');
        input.type = type;
        input.name = name;
        input.classList.add('form-control');

        div.appendChild(label);
        div.appendChild(input);
        container.appendChild(div);

        return input;
    }

    function showDetails(index) {
        const detailsSection = document.getElementById(`partDetails`).children[index - 1];
        detailsSection.style.display = 'block';
    }
</script>

</body>
</html>