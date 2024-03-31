# API Documentation

## Introduction
This API provides endpoints for managing doctor appointments and related functionalities. Below are the details of the available endpoints and their usage.

## Doctor Registration
To register as a doctor, send a POST request to `/OnlineDoctorAppointment/back/SignupDoc/Signup` with the following data in the request body:
- first
- last
- fileNumber
- phoneNumber
- city
- clinicAddress
- major
- expertise
- email
- gender

Note: Ensure that the data is formatted as specified and follows the guidelines mentioned in the API documentation.

## Set Doctor's Password
After registering, send the doctor's password to `/OnlineDoctorAppointment/back/SignupDoc/setPass` to complete the account setup.

## Doctor Login Using JWT
For JWT-based login, send a POST request to `/OnlineDoctorAppointment/back/loginDoc/loginJwt` with the client's cookies. If the JWT is valid, the API will return a true JSON response.

## Standard Doctor Login
Alternatively, for standard login, send a POST request to `/OnlineDoctorAppointment/back/loginDoc/login`. The API supports login using email, username, or phone number, along with the password.

## Doctor Dashboard
Upon successful login, access the doctor's dashboard data by sending a POST request to `/OnlineDoctorAppointment/back/doctorDahsboard/dashboard`. This endpoint provides the doctor's appointment schedule.

## Reserve Time Slot
Doctors can reserve time slots for themselves by sending a request to `/OnlineDoctorAppointment/back/doctorDashboard/changeTable` with the specified date and time in the URL. Use the PUT method for this request.

## Delete Appointment
To delete a doctor's appointment, send a DELETE request to `/OnlineDoctorAppointment/back/doctorDashboard/changeTable?AppointmentID=1`, where "1" is the appointment ID.

## Update Doctor Profile Picture
Doctors can upload a profile picture using a POST request to `/OnlineDoctorAppointment/back/doctorDashboard/changeProfile`. The image should be in JPEG format and below 1MB in size.

## Update Doctor Information
Update the doctor's information by sending a PUT request to `/OnlineDoctorAppointment/back/doctorDashboard/changeProfile`. Include the desired changes in the URL parameters.

## Search Engine
Utilize the search engine by sending a POST request to `/OnlineDoctorAppointment/back/onlineReservation/searchEngine/searchEngine`. The API returns a JSON array based on the provided input, with the option to specify sorting criteria.

## View Doctor Information
Retrieve a doctor's profile image by sending a GET request to `/OnlineDoctorAppointment/back/onlineReservation/showDocInfo/showDocImage?id=20000`, where "20000" is the doctor's ID.

## Reserve Appointment
Patients can reserve appointments by sending a POST request to `/OnlineDoctorAppointment/back/onlineReservation/reserveAppointment/reserveAppointment`. Include the required details in the request body.

## Cancel Appointment
Patients can cancel their reservations by sending a POST request to `/OnlineDoctorAppointment/back/onlineReservation/reserveAppointment/cancelReservation` with the appointment ID in the request body. The API will return a JSON response confirming the cancellation.

## View Doctor's Schedule
Retrieve a doctor's schedule by sending a POST request to `/OnlineDoctorAppointment/back/onlineReservation/showDocInfo/showDocSchedule` with the doctor's ID in the request body.

## Conclusion
This documentation provides an overview of the available endpoints and their usage. For further details, refer to the API documentation or contact the API provider.
