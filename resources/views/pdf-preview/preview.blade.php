

<script>
        // This function opens the PDF in a new tab
        window.onload = function() {
            var pdfUrl = "{{ $pdfFile }}"; // Use the PDF URL passed from the controller
            window.open(pdfUrl, '_blank'); // Opens the PDF in a new tab
        }
    </script>
<iframe src="{{ asset($pdfFile) }}" width="100%" height="100%"></iframe>
