<!-- pages/itemlist.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Search Results</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            /* background-color: green; */
        }

        th {
            border: 1px solid black;
            padding: 8px;
            background-color: #17a2b8;
            color: #ffffff;
        }

        td {
            border: 1px solid black;
            padding: 8px;
        }

        .td-center{
            text-align: center;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Items List</h1>
    <table>
        <thead>
            <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Item ID</th>
                <th class="text-center" scope="col">Item Code</th>
                <th class="text-center" scope="col">Item Name</th>
                <th class="text-center" scope="col">Category Name</th>
                <th class="text-center" scope="col">Safety Stock</th>
                <th class="text-center" scope="col">Received Date</th>
                <th class="text-center" scope="col">Description</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($items as $row)
                <tr>
                    <td class="td-center">{{ $loop->iteration }}</td>
                    <td class="td-center">{{ $row['item_id'] }}</td>
                    <td class="td-center">{{ $row['item_code'] }}</td>
                    <td class="">{{ $row['item_name'] }}</td>
                    <td class="">{{ $row['category_name'] }}</td>
                    <td class="td-center">{{ $row['safety_stock'] }}</td>
                    <td class="td-center">{{ $row['received_date'] }}</td>
                    <td class="td-center">{{ $row['description'] }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
