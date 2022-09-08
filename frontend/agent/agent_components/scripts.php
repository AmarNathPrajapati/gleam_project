 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>


<script>
        // document.onreadystatechange = function () {
        //     if (document.readyState !== "complete") {
        //         document.querySelector(
        //             "body").style.visibility = "hidden";
        //         document.querySelector(
        //             "#loader").style.visibility = "visible";
        //     } else {
        //         document.querySelector(
        //             "#loader").style.display = "hidden";
        //         document.querySelector(
        //             "body").style.visibility = "visible";

        //     }
        // };
    </script>

    <script>
         document.querySelector(
                "#loader").style.visibility = "hidden";

        function showloader() {

            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loader").style.visibility = "visible";
            document.querySelector(
                "#loader").style.zIndex = "2";

            return true;
        }
    </script>

    