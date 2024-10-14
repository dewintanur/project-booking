import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom';   x   
import RoomBooking from './RoomBooking';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";

if (document.getElementById('room-booking')) {
    ReactDOM.render(<RoomBooking />, document.getElementById('room-booking'));
    flatpickr("#date{{ $ruang->id }}", {
        inline: true,
        mode: "multiple",
        dateFormat: "Y-m-d",
        // Opsi tambahan di sini
    });
    
}
