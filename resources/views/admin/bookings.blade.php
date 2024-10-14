<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Bookings (Frontend Only)</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* General body and font styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f8fa;
            margin: 0;
        }

        /* Sidebar styling */
        .sidebar {
            width: 220px;
            background-color: #2f3b52;
            position: fixed;
            height: 100%;
            padding: 20px;
            color: white;
        }
        .sidebar h2 {
            font-size: 1.5rem;
            color: #fff;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 20px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #d1d4db;
            font-size: 1rem;
        }
        .sidebar ul li a:hover {
            color: #fff;
        }

        /* Main content area */
        .content {
            margin-left: 240px;
            padding: 20px;
        }

        /* Header styling */
        .header {
            background-color: #f7f8fa;
            padding: 10px;
            border-bottom: 1px solid #e1e4e8;
        }
        .header h2 {
            font-size: 1.75rem;
            color: #333;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #333;
        }
        th {
            background-color: #f1f3f6;
            color: #5a5f6b;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f7f8fa;
        }

        /* Input styling for search */
        input[type="search"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #d1d4db;
            border-radius: 4px;
        }

        /* Dropdowns (filters) */
        select {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #d1d4db;
            border-radius: 4px;
            background-color: #fff;
        }

        /* Footer for buttons or additional actions */
        .footer {
            margin-top: 20px;
            text-align: right;
        }

        /* Button styling */
        .btn {
            background-color: #5a5f6b;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #333;
        }

        /* Status button */
        .status-btn {
            padding: 6px 12px;
            background-color: #5a5f6b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .status-btn:hover {
            background-color: #333;
        }

        /* Success message */
        .success-message {
            color: green;
            margin-bottom: 10px;
            display: none;
        }

        /* Popup modal */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.4); 
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 30%; 
            border-radius: 10px;
            text-align: center;
        }

        .modal-content button {
            margin: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .modal-content .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .modal-content .btn-reject {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>MCC Admin</h2>
        <ul>
            <li><a href="/admin/bookings">Booking</a></li>
            <li><a href="/admin/rooms">Rooms</a></li>
            <li><a href="/admin/videos">Videos</a></li>
            <li><a href="/admin/users">Users</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="header">
            <h2>Bookings</h2>
        </div>

        <!-- Success message -->
        <div class="success-message" id="success-message">
            Status updated successfully!
        </div>

        <div class="filters">
            <select>
                <option>Semua Kategori</option>
                <option>Komunitas / Musik</option>
                <!-- Add other categories as necessary -->
            </select>
            <select>
                <option>Semua Lantai</option>
                <!-- Add floor options as necessary -->
            </select>
            <select>
                <option>Semua Status</option>
                <!-- Add status options as necessary -->
            </select>
            <input type="search" placeholder="Masukkan kata yang dicari" />
        </div>

        <table>
            <thead>
                <tr>
                    <th>Booking Code</th>
                    <th>Event Name</th>
                    <th>Location & Time</th>
                    <th>Date Requested</th>
                    <th>Organizer</th>
                    <th>Status Booking</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking['code'] }}</td>
                    <td>{{ $booking['event_name'] }}</td>
                    <td>{{ $booking['location'] }} <br> {{ $booking['date'] }}</td>
                    <td>{{ $booking['date_requested'] }}</td>
                    <td>{{ $booking['organizer'] }} <br> PIC: {{ $booking['pic'] }}</td>
                    <td>
                        <!-- Display the current status -->
                        <span id="status-{{ $booking['code'] }}">{{ $booking['status'] }}</span>
                    </td>
                    <td>
                        <!-- Button to change status -->
                        <button class="status-btn" onclick="openModal('{{ $booking['code'] }}')">Change Status</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <button class="btn">Add New Booking</button>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <h3>Change Booking Status</h3>
            <p>Choose the new status:</p>
            <button class="btn-approve" onclick="updateStatus(selectedCode, 'Approved')">Approve</button>
            <button class="btn-reject" onclick="updateStatus(selectedCode, 'Rejected')">Reject</button>
        </div>
    </div>

    <script>
        let selectedCode;

        // Function to open the modal and pass the booking code
        function openModal(code) {
            selectedCode = code;
            document.getElementById('statusModal').style.display = 'block';
        }

        // Function to close the modal after status update
        function closeModal() {
            document.getElementById('statusModal').style.display = 'none';
        }

        // Function to update status in the frontend
        function updateStatus(code, newStatus) {
            // Simulate the update by changing the status in the table
            document.getElementById(`status-${code}`).innerText = newStatus;

            // Show success message
            document.getElementById('success-message').style.display = 'block';
            setTimeout(() => {
                document.getElementById('success-message').style.display = 'none';
            }, 3000);

            // Close the modal
            closeModal();
        }

        // Close modal on click outside the content
        window.onclick = function(event) {
            const modal = document.getElementById('statusModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>
