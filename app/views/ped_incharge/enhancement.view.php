<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enhancement Letters</title>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/ped_incharge/letters.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
  <?php $current_page = 'letters'; include 'sidebar.view.php'?>

  <!-- Header and Main Content -->
  <div class="main-content">

      <div class="header">
          <h1>Enhancement Letters</h1>
      </div>
    <main>
    <div class="container">
        <div class="document-list">
            <!-- Sample Document Card -->
            <div class="document-card">
                <div class="document-header">
                    <h3>Enhancement Letter Request</h3>
                    <span class="document-status status-pending">Pending</span>
                </div>
                <div class="document-details">
                    <div class="detail-item">
                        <span class="detail-label">Student Name</span>
                        <span class="detail-value">K.V Silva</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Registration Number</span>
                        <span class="detail-value">2024CS001</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Faculty</span>
                        <span class="detail-value">Science</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Academic Year</span>
                        <span class="detail-value">2023/24</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sport</span>
                        <span class="detail-value">Basketball</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tournament</span>
                        <span class="detail-value">Inter-University Championship</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tournament Date</span>
                        <span class="detail-value">15-20 March 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Submission Date</span>
                        <span class="detail-value">22 March 2024</span>
                    </div>
                </div>
                <div class="document-actions">
                    <button class="btn-approve" onclick="showSignatureDialog()">Approve & Sign</button>
                    <button class="btn-forward">Forward to Faculty</button>
                    <button class="btn-reject" onclick="rejectDocument()">Reject</button>
                </div>
            </div>

            <div class="document-card">
                <div class="document-header">
                    <h3>Enhancement Letter Request</h3>
                    <span class="document-status status-pending">Pending</span>
                </div>
                <div class="document-details">
                    <div class="detail-item">
                        <span class="detail-label">Student Name</span>
                        <span class="detail-value">Sanudi Yapa</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Index number</span>
                        <span class="detail-value">202023782</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Registration Number</span>
                        <span class="detail-value">2022IS117</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Faculty</span>
                        <span class="detail-value">UCSC</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Academic Year</span>
                        <span class="detail-value">2023/24</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sport</span>
                        <span class="detail-value">Hockey</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tournament</span>
                        <span class="detail-value">Inter-University Championship</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Achievement</span>
                        <span class="detail-value">Semi finals</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Remarks</span>
                        <span class="detail-value">Got SLUSA colors</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tournament Date</span>
                        <span class="detail-value">15-20 August 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Submission Date</span>
                        <span class="detail-value">22 March 2024</span>
                    </div>
                </div>
                <div class="document-actions">
                    <button class="btn-approve" onclick="showSignatureDialog()">Approve & Sign</button>
                    <button class="btn-forward">Forward to Faculty</button>
                    <button class="btn-reject" onclick="rejectDocument()">Reject</button>
                </div>
            </div>

            <div class="document-card">
                <div class="document-header">
                    <h3>Enhancement Letter Request</h3>
                    <span class="document-status status-pending">Pending</span>
                </div>
                <div class="document-details">
                    <div class="detail-item">
                        <span class="detail-label">Student Name</span>
                        <span class="detail-value">P.U Piyumini</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Index number</span>
                        <span class="detail-value">202023782</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Registration Number</span>
                        <span class="detail-value">2024CS001</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Faculty</span>
                        <span class="detail-value">UCSC</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Academic Year</span>
                        <span class="detail-value">2023/24</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sport</span>
                        <span class="detail-value">Basketball</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tournament</span>
                        <span class="detail-value">Inter-University Championship</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Achievement</span>
                        <span class="detail-value">Champions</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Remarks</span>
                        <span class="detail-value"></span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tournament Date</span>
                        <span class="detail-value">15-20 March 2024</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Submission Date</span>
                        <span class="detail-value">22 March 2024</span>
                    </div>
                </div>
                <div class="document-actions">
                    <button class="btn-approve" onclick="showSignatureDialog()">Approve & Sign</button>
                    <button class="btn-forward">Forward to Faculty</button>
                    <button class="btn-reject" onclick="rejectDocument()">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Digital Signature Dialog -->
    <div class="overlay" id="overlay"></div>
    <div class="digital-signature" id="signatureDialog">
        <h3>Add Digital Signature</h3>
        <canvas id="signatureCanvas" width="400" height="200"></canvas>
        <div class="signature-actions">
            <button onclick="clearSignature()">Clear</button>
            <button class="btn-approve" onclick="applySignature()">Apply Signature</button>
            <button class="btn-reject" onclick="closeSignatureDialog()">Cancel</button>
        </div>
    </div>

 
    </main>
    <script>
        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');

        // Initialize canvas settings
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';

        // Signature pad event listeners
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        function startDrawing(e) {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY];
        }

        function draw(e) {
            if (!isDrawing) return;
            
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY];
        }

        function stopDrawing() {
            isDrawing = false;
        }

        function clearSignature() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function showSignatureDialog() {
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('signatureDialog').style.display = 'block';
        }

        function closeSignatureDialog() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('signatureDialog').style.display = 'none';
            clearSignature();
        }

        function applySignature() {
            // Here you would typically:
            // 1. Convert the canvas to an image (e.g., using canvas.toDataURL())
            // 2. Send the signature to your server
            // 3. Update the document status
            
            alert('Document approved and signed successfully!');
            closeSignatureDialog();
            
            // Update status indicator
            const statusSpan = document.querySelector('.document-status');
            statusSpan.textContent = 'Approved';
            statusSpan.classList.remove('status-pending');
            statusSpan.style.backgroundColor = '#d4edda';
            statusSpan.style.color = '#155724';
        }

        function rejectDocument() {
            const reason = prompt('Please enter the reason for rejection:');
            if (reason) {
                alert('Document rejected. Reason: ' + reason);
                
                // Update status indicator
                const statusSpan = document.querySelector('.document-status');
                statusSpan.textContent = 'Rejected';
                statusSpan.classList.remove('status-pending');
                statusSpan.style.backgroundColor = '#f8d7da';
                statusSpan.style.color = '#721c24';
            }
        }

        function viewDocument() {
            // Here you would typically open the actual document
            alert('Opening document viewer...');
        }
    </script>
    <script src="<?=ROOT?>/assets/js/ped_incharge/navbar.js"></script>
</body>
</html>