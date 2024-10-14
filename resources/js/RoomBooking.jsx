import React, { useState } from 'react';
import DatePicker from 'react-datepicker';
import Select from 'react-select';
import 'react-datepicker/dist/react-datepicker.css';
import './index.css';

const RoomBooking = () => {
  const [startDate, setStartDate] = useState(null);
  const [showModal, setShowModal] = useState(false);
  const [selectedTimes, setSelectedTimes] = useState([]);

  const availableTimes = [
    { value: '08:00 - 09:00', label: '08:00 - 09:00' },
    { value: '09:00 - 10:00', label: '09:00 - 10:00' },
    { value: '10:00 - 11:00', label: '10:00 - 11:00' },
    { value: '11:00 - 12:00', label: '11:00 - 12:00' },
    { value: '12:00 - 13:00', label: '12:00 - 13:00' },
    { value: '13:00 - 14:00', label: '13:00 - 14:00' },
    { value: '14:00 - 15:00', label: '14:00 - 15:00' },
    { value: '15:00 - 16:00', label: '15:00 - 16:00' },
    { value: '16:00 - 17:00', label: '16:00 - 17:00' },
    { value: '17:00 - 18:00', label: '17:00 - 18:00' },
    { value: '18:00 - 19:00', label: '18:00 - 19:00' },
    { value: '19:00 - 20:00', label: '19:00 - 20:00' },
    { value: '20:00 - 21:00', label: '20:00 - 21:00' }
  ];

  const handleBooking = () => {
    alert(`Booking Date: ${startDate}, Times: ${selectedTimes.map((time) => time.label).join(', ')}`);
    setShowModal(false); // Close modal after booking
  };

  return (
    <div className="flex items-center justify-center min-h-screen">
      <button onClick={() => setShowModal(true)} className="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
        Booking Ruangan
      </button>

      {showModal && (
        <div className="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
          <div className="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 className="text-lg font-semibold mb-4">Pilih Jadwal Ruangan</h2>

            <div className="mb-4">
              <label className="block text-sm font-medium text-gray-700 mb-2">Pilih Tanggal</label>
              <DatePicker
                selected={startDate}
                onChange={(date) => setStartDate(date)}
                dateFormat="dd/MM/yyyy"
                className="w-full border-gray-300 rounded-md shadow-sm"
                placeholderText="Select a date"
              />
            </div>

            <div className="mb-4">
              <label className="block text-sm font-medium text-gray-700 mb-2">Pilih Jam (Multiple)</label>
              <Select
                isMulti
                options={availableTimes}
                value={selectedTimes}
                onChange={(selected) => setSelectedTimes(selected)}
                className="basic-multi-select"
                classNamePrefix="select"
              />
            </div>

            <div className="flex justify-end gap-2">
              <button className="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400" onClick={() => setShowModal(false)}>
                Batal
              </button>
              <button className="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700" onClick={handleBooking}>
                Booking
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default RoomBooking;
