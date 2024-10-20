<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/induksi.css') }}">
    <title>Induksi</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">My Website</div>
        </nav>
    </header>

    <div class="container">
        <aside class="sidebar">
            <ul>
                <li><a href="#tabel" id="tabelLink"><b>Table</b></a></li>
            </ul>
        </aside>

        <main class="content">
            <h1>Welcome to the content section!</h1>
            {{-- form --}}
            {{-- <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form> --}}
            {{-- TABLE --}}
                <h3 style="margin-bottom: 10px">Todo list</h3>
                <table border="1" style="margin-top: 10px">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th style="width: 150px">Title</th>
                            <th>Completed</th>
                            <th>User ID</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        
                    </tbody>
                </table>
        </main>
    </div>
    </div>

    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

    <!-- jQuery (required by DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Set up table visibility toggle
            document.getElementById("tabelLink").addEventListener("click", function(e) {
                e.preventDefault();
                var table = document.getElementById("dashboardTable");
                if (table.style.display === "none") {
                    table.style.display = "block";
                } else {
                    table.style.display = "none";
                }
            });

            // FETCH DATA
            const url = 'https://jsonplaceholder.typicode.com/todos';
            fetch(url)
                .then(response => response.json())
                .then(json => {
                    const tableBody = document.getElementById('table-body');
                    let rowNumber = 1; // Initialize row counter
    
                    // Clear the table body before adding new data (in case of multiple fetches)
                    tableBody.innerHTML = '';
    
                    // Append data to the table
                    json.forEach(item => {
                        const row = document.createElement('tr');
    
                        // Row number
                        const numberCell = document.createElement('td');
                        numberCell.textContent = rowNumber++;
                        row.appendChild(numberCell);
    
                        // Title
                        const titleCell = document.createElement('td');
                        titleCell.textContent = item.title;
                        row.appendChild(titleCell);
    
                        // Completed
                        const completedCell = document.createElement('td');
                        completedCell.textContent = item.completed ? 'Completed' : 'Not Completed';
                        row.appendChild(completedCell);
    
                        // User ID
                        const userIdCell = document.createElement('td');
                        userIdCell.textContent = item.userId;
                        row.appendChild(userIdCell);
    
                        // Append the row to the table body
                        tableBody.appendChild(row);
                    });
    
                    // Initialize or reinitialize DataTables after data is added
                    if ($.fn.dataTable.isDataTable('#dashboardTable table')) {
                        // If DataTable is already initialized, destroy and reinitialize it
                        $('#dashboardTable table').DataTable().destroy();
                    }
    
                    // Initialize DataTables once the data is loaded
                    $('#dashboardTable table').DataTable({
                        responsive: true,
                        pageLength: 10 // Set how many rows per page
                    });
                })
                .catch(error => console.error('Error fetching data:', error));

                    
            // POST DATA
            const todo = {
                completed: false,
                title: 'Induksi Front-End BSI UII',
                userId: 1
            };
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(todo),
            })
                .then(response => response.json())
                .then(json => console.log(json));
    
        });
    </script>


    </body>
</html>