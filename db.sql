SELECT *
FROM bookings
LEFT JOIN cars
ON bookings.car_id = cars.car_id WHERE cars.agency_id=1;

SELECT bookings.booking_id,bookings.from_date,bookings.days,customers.name
FROM ((bookings
LEFT JOIN cars ON cars.car_id = bookings.booking_id)
LEFT JOIN customers ON customers.customer_id=bookings.booking_id);

$con=mysqli_connect("localhost","root","","car rent") ;
$con=mysqli_connect("sql104.epizy.com","epiz_33436101","9lq2Nl4npZNB9L","epiz_33436101_carsrent") ;