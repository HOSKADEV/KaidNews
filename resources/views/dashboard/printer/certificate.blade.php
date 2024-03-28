<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ trans('print.title_print.trainee_notebook') . '_' . $account->name }} </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vw;
            width: 100vh;
        }

        .print-page {
            margin: 0;
            padding: 0;
            height: 100vw;
            width: 100vh;
            
        }

        @page {
            margin-top: 0;
            margin-bottom: 0;
        }

        @page: first {
            margin-top: 0;
        }

        @page: first {
            margin-top: 0;
        }
        @media print {
            .no-print {
                display: none;

            }

            body {
                background-color: red;
                height: 100vw;
                width: 100vh;
                margin: 0;
                padding: 0;
                min-width :100vh;
                min-height :100vw;
            }
            .print-page{
                height: 100vw;
                width: 100vh;
                margin: 0;
                padding: 0;
                background-color: red; 
                min-width :100vh;
                min-height :100vw;
                width: 100vh; /* Use the viewport height as width */
            height: 100vw; /* Use the viewport width as height */
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div style="" class="print-page">
        k
    </div>

    <script>
        // window.print();
    </script>

    <script>
        // JavaScript to remove the print page link
        window.onload = function() {
            var links = document.getElementsByTagName("a");
            for (var i = 0; i < links.length; i++) {
                if (links[i].getAttribute("href") === "javascript:window.print()") {
                    links[i].parentNode.removeChild(links[i]);
                    break;
                }
            }
        };
    </script>

</body>

</html>
