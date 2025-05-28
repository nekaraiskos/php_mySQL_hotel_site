-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 11 Σεπ 2024 στις 15:22:15
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `hotel`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `activity`
--

CREATE TABLE `activity` (
  `ServiceID` int(11) NOT NULL,
  `DifficultyLevel` varchar(20) DEFAULT NULL,
  `MinimumAge` int(11) DEFAULT NULL,
  `GuideRequired` tinyint(1) DEFAULT NULL,
  `Duration` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `activity`
--

INSERT INTO `activity` (`ServiceID`, `DifficultyLevel`, `MinimumAge`, `GuideRequired`, `Duration`) VALUES
(1, 'All levels available', 5, 0, 'No limit'),
(4, 'Easy, moderate,', 10, 0, '45 per session'),
(5, 'Moderate, difficult', 5, 0, 'No limit'),
(6, NULL, 3, 0, 'No limit'),
(7, 'Moderate, Challengin', 12, 1, '2 hours');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `admin_table`
--

CREATE TABLE `admin_table` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `admin_table`
--

INSERT INTO `admin_table` (`AdminID`, `Username`, `pwd`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `book_service`
--

CREATE TABLE `book_service` (
  `AppointedTime` time DEFAULT NULL,
  `NumOfPeople` int(11) DEFAULT NULL,
  `DateOfBooking` date DEFAULT current_timestamp(),
  `FullPrice` int(11) DEFAULT NULL,
  `BookingID` int(11) NOT NULL,
  `FK1_CustomerID` int(11) NOT NULL,
  `FK2_ServiceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `book_service`
--

INSERT INTO `book_service` (`AppointedTime`, `NumOfPeople`, `DateOfBooking`, `FullPrice`, `BookingID`, `FK1_CustomerID`, `FK2_ServiceID`) VALUES
('23:00:00', 1, '2024-08-26', 20, 1, 1, 5),
('18:30:00', 10, '2024-08-26', 150, 2, 1, 2),
('20:00:00', 2, '2024-08-26', 80, 3, 1, 3),
('05:00:00', 1, '2024-08-27', 40, 4, 1, 3),
('22:00:00', 3, '2024-08-29', 60, 5, 1, 5),
('19:00:00', 2, '2024-09-05', 40, 6, 1, 5);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `combination`
--

CREATE TABLE `combination` (
  `RoomID` int(11) NOT NULL,
  `SpecialOfferID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `combination`
--

INSERT INTO `combination` (`RoomID`, `SpecialOfferID`) VALUES
(12, 2),
(13, 2),
(17, 1),
(18, 1),
(18, 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `culinary_experience`
--

CREATE TABLE `culinary_experience` (
  `ServiceID` int(11) NOT NULL,
  `MealType` varchar(20) DEFAULT NULL,
  `MenuOptions` varchar(20) DEFAULT NULL,
  `DressCode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `culinary_experience`
--

INSERT INTO `culinary_experience` (`ServiceID`, `MealType`, `MenuOptions`, `DressCode`) VALUES
(3, 'Any', 'Any', 'Any'),
(12, 'Cocktails&Appetizers', 'Small Plates', 'Smart Casual'),
(13, 'Dinner', 'Vegan, Gluten-Free', 'Formal'),
(15, 'Breakfast', 'Vegan, Gluten-Free', 'Casual'),
(16, 'All-Day Dining', 'Vegan, Gluten-Free', 'Any');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `customer`
--

CREATE TABLE `customer` (
  `PhoneNumber` char(15) DEFAULT NULL,
  `FName` varchar(30) DEFAULT NULL,
  `LName` varchar(20) DEFAULT NULL,
  `CustomerID` int(11) NOT NULL,
  `pwd` varchar(70) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Username` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `customer`
--

INSERT INTO `customer` (`PhoneNumber`, `FName`, `LName`, `CustomerID`, `pwd`, `Email`, `Username`) VALUES
('9864578600', 'Anastasis', 'Choco', 1, '$2y$12$ZrysYx4hKleYXHVF/4xcGe.yOVW0D3wbNABdKef3LKWJUBguWWBKO', 'toni@gmail.com', 'Toni'),
('1234567890', 'Apostolos', 'Diamantis', 2, '$2y$12$INWCi7Mr/YiZ9BstJ6ARb.IGTvVam9hn1/mUyOv.gHKiHamAq9E7C', 'tolis@gmail.com', 'Tolis'),
('9864578600', 'Celia', 'Diamanti', 4, '$2y$12$TiTcGn.h/J1EJuPWkdMtLuY9GK0hQXsyQkWHnMPveP2zTAb44B60e', 'celiadiamandi@gmail.com', 'celia1502');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `makes_simple_resrv`
--

CREATE TABLE `makes_simple_resrv` (
  `ReservationID` int(11) NOT NULL,
  `DateOfReservation` date DEFAULT current_timestamp(),
  `FullPrice` int(11) DEFAULT NULL,
  `CheckIn` date NOT NULL,
  `CheckOut` date NOT NULL,
  `FK1_CustomerID` int(11) NOT NULL,
  `FK2_RoomID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `makes_simple_resrv`
--

INSERT INTO `makes_simple_resrv` (`ReservationID`, `DateOfReservation`, `FullPrice`, `CheckIn`, `CheckOut`, `FK1_CustomerID`, `FK2_RoomID`) VALUES
(18, '2024-08-27', 250, '2024-09-01', '2024-09-07', 1, 12),
(19, '2024-08-27', 300, '2024-09-01', '2024-09-07', 1, 18),
(20, '2024-08-27', 320, '2024-09-02', '2024-09-06', 1, 13),
(21, '2024-08-29', 400, '2024-09-08', '2024-09-13', 1, 13),
(22, '2024-09-05', 150, '2024-10-06', '2024-10-11', 1, 12),
(23, '2024-09-07', 180, '2024-09-22', '2024-09-28', 1, 12);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `makes_special_resrv`
--

CREATE TABLE `makes_special_resrv` (
  `ReservationID` int(11) NOT NULL,
  `FullPrice` int(11) NOT NULL,
  `DateOfReservation` date DEFAULT current_timestamp(),
  `CheckIn` date NOT NULL,
  `CheckOut` date NOT NULL,
  `FK1_CustomerID` int(11) NOT NULL,
  `FK2_RoomID` int(11) NOT NULL,
  `FK3_SpecialOfferID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `makes_special_resrv`
--

INSERT INTO `makes_special_resrv` (`ReservationID`, `FullPrice`, `DateOfReservation`, `CheckIn`, `CheckOut`, `FK1_CustomerID`, `FK2_RoomID`, `FK3_SpecialOfferID`) VALUES
(9, 225, '2024-08-29', '2024-09-08', '2024-09-14', 1, 18, 1),
(10, 360, '2024-08-29', '2024-09-15', '2024-09-21', 1, 13, 2),
(11, 878, '2024-08-29', '2024-09-15', '2024-10-11', 1, 17, 1),
(12, 113, '2024-09-05', '2024-09-29', '2024-10-04', 1, 12, 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room`
--

CREATE TABLE `room` (
  `RoomName` varchar(30) NOT NULL,
  `HasHotTub` tinyint(1) DEFAULT NULL,
  `RoomType` varchar(30) DEFAULT NULL,
  `NumOfBeds` int(11) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `PricePerNight` int(11) DEFAULT NULL,
  `RoomID` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `room`
--

INSERT INTO `room` (`RoomName`, `HasHotTub`, `RoomType`, `NumOfBeds`, `Capacity`, `PricePerNight`, `RoomID`, `Image`) VALUES
('Royal Life', 1, 'Queen', 1, 2, 30, 12, 'images/Queen.jpg'),
('Rock&Roll', 1, 'Double', 2, 2, 80, 13, 'images/Rock&Roll.jpg'),
('Peace and Quiet', 1, 'Single', 1, 1, 35, 16, 'images/single_lux.jpg'),
('Love Suite', 0, 'Double', 1, 2, 45, 17, 'images/lux_double.jfif'),
('Love For two', 1, 'Double', 1, 2, 50, 18, 'images/room3.jpg');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `service`
--

CREATE TABLE `service` (
  `Price` int(11) DEFAULT NULL,
  `BookingRequired` tinyint(1) NOT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `ServiceName` varchar(30) DEFAULT NULL,
  `ServiceID` int(11) NOT NULL,
  `AvailabilityHours` varchar(20) DEFAULT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `service`
--

INSERT INTO `service` (`Price`, `BookingRequired`, `Description`, `ServiceName`, `ServiceID`, `AvailabilityHours`, `Image`) VALUES
(10, 0, 'Experience the thrill of climbing right within our hotel! Our state-of-the-art indoor climbing facility offers an exhilarating experience for climbers of all skill levels. Whether you\'re a seasoned climber or a beginner our climbing walls provide a range of routes and challenges.', 'Indoor climbing', 1, '09:00 - 22:00', 'images/indoor_climbing.jfif'),
(20, 1, 'Escape to our serene spa, where expert therapists offer personalized treatments, from soothing massages to revitalizing facials. Enjoy our tranquil atmosphere, luxury amenities, and a full range of wellness services designed to refresh your body and mind. Relax, rejuvenate, and unwind.', 'Spa', 2, '09:00 - 22:00', 'images/spa.jfif'),
(40, 1, 'Indulge in a bespoke dining experience with our private chef. Enjoy gourmet meals crafted to your taste, in the comfort of your suite or any location you choose. Perfect for intimate dinners, celebrations, or savoring exquisite cuisine without leaving your space.', 'Private Dinner', 3, '19:00 - 23:00', 'images/private.webp'),
(12, 0, 'Glide across a frozen lake nestled beside a serene forest. Enjoy a magical ice skating experience surrounded by natural beauty. Perfect for families, couples, and anyone seeking winter fun in a breathtaking setting. Create unforgettable memories on the ice.', 'Ice Skating', 4, '11:00 - 18:00', 'images/ice_skating.jpg'),
(20, 1, 'Hit the slopes for an exhilarating ski or snowboarding experience. Perfect for all skill levels, enjoy breathtaking mountain views and expertly groomed trails. Whether you\'re seeking thrills or a leisurely ride, our winter wonderland awaits.', 'Ski/Snowboarding', 5, '09:00 - 16:00', 'images/ski.jpg\r\n'),
(0, 0, 'Designed for children of all ages, our playground offers a safe, exciting, and imaginative environment that promises endless entertainment. Whether rain or shine, your little ones can enjoy a world of adventure right within our hotel.', 'Indoor Playground', 6, '09:00 - 19:00', 'images/playground.jpg'),
(50, 1, 'Get ready to rev up your winter with an exhilarating snowmobiling experience! Our guided snowmobile tours take you through breathtaking snowy landscapes, offering an adrenaline-pumping adventure that’s perfect for thrill-seekers and nature lovers alike. Whether you’re a seasoned rider or a first-tim', 'Snowmobiling', 7, '10:00 - 16:00', 'images/Snowmobiling.jpg'),
(100, 1, 'Challenge yourself with an exhilarating ice climbing experience in the heart of winter’s beauty! Our guided ice climbing tours offer a unique and thrilling adventure for those looking to conquer frozen heights. Whether you’re a seasoned climber or a beginner ready to embrace a new challenge, our exp', 'Ice Clibing', 8, '16:00 - 20:00', 'images/Ice_Clibing.jpg'),
(15, 1, 'Refresh and rejuvenate your skin with our luxurious face treatments. Tailored to your skin’s needs, our expert therapists use premium products to cleanse, hydrate, and revitalize your complexion. Leave with glowing, youthful, and radiant skin.', 'Facial Treatment', 9, '10:00 - 20:00', 'images/Facial_Treatment.jpg'),
(15, 1, 'Unwind in our soothing sauna, designed for ultimate relaxation. Enjoy the calming heat that helps relieve stress, relax muscles, and detoxify your body. Perfect for a rejuvenating experience after a day of activities or to simply unwind and refresh.', 'Sauna', 10, '07:00 - 16:00', 'images/Sauna.jpg'),
(8, 1, 'Soak in our rejuvenating thermal pools, designed for ultimate relaxation and wellness. Experience the soothing effects of naturally heated mineral waters, which promote muscle relaxation, improve circulation, and relieve stress. Ideal for unwinding and enhancing your overall well-being.', 'Thermal Pools', 11, '09:00 - 19:00', 'images/Thermal_Pools.jpg'),
(15, 0, 'Unwind at our stylish hotel bar, offering a curated selection of cocktails, fine wines, and craft beers. Enjoy a sophisticated ambiance, comfortable seating, and attentive service, perfect for socializing or relaxing after a day of activities.', 'Bar', 12, '19:00 - 04:00', 'images/bar.jpg'),
(15, 1, 'Enjoy a varied dining experience with our diverse menu. Choose from à la carte dishes, hearty mains, and delectable desserts, all crafted from fresh, high-quality ingredients. Whether you\'re in the mood for a fine dining experience or casual fare, we have something for every taste.', 'Restaurant', 13, '13:00 - 22:00', 'images/Restaurant.jpg'),
(5, 0, 'Begin your day at our cozy hotel café, offering a variety of breakfast options. Enjoy fresh pastries, gourmet coffee, hearty sandwiches, and fruit, all in a relaxed and inviting setting. Perfect for a delightful morning meal right within the hotel.', 'Café', 15, '07:00 - 19:00', 'images/Cafe.jpg'),
(10, 0, 'Indulge in a diverse array of dishes at our Buffet Lounge. Enjoy a relaxed atmosphere with a selection of fresh, flavorful options, from hearty breakfast items to savory lunch and dinner choices. Perfect for a casual and satisfying dining experience throughout the day.', 'Buffet Lounge', 16, '08:00 - 20:00', 'images/Buffet_Lounge.jfif');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `special_offer`
--

CREATE TABLE `special_offer` (
  `SpecialOfferID` int(11) NOT NULL,
  `Description` varchar(300) DEFAULT NULL,
  `Discount` int(11) DEFAULT NULL,
  `Image` varchar(255) NOT NULL,
  `ServiceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `special_offer`
--

INSERT INTO `special_offer` (`SpecialOfferID`, `Description`, `Discount`, `Image`, `ServiceID`) VALUES
(1, 'Enjoy a romantic getaway with our special couples offer. Stay in a beautifully appointed room and indulge in unlimited spa sessions, designed to relax and rejuvenate. Perfect for couples seeking a luxurious escape.', 25, 'images/couple_spa.avif', 2),
(2, 'Enjoy a cozy stay for four and take advantage of free ski passes for the entire family. Book now and embrace the ultimate winter adventure!', 25, 'images/adventure.jpg', 5),
(3, 'Enjoy a free pass to our buffet with your stay! Savor a variety of delicious dishes, from breakfast to dinner, at no extra cost. Perfect for food lovers seeking a culinary adventure during their visit. Book now to treat yourself to endless dining delights!', 25, 'images/buffer_offer.jpg', 16),
(4, 'Try a free ice climbing session, perfect for thrill-seekers looking to conquer new heights together. Experience the excitement and challenge of ice climbing, all while creating unforgettable memories.', 30, 'images/ice_climbing_for_two.jpg', 8),
(6, 'Celebrate Christmas with our exclusive offer! Enjoy a great discount and experience the magic of free skating on the lake next to the Christmas tree. This limited edition package is perfect for creating festive memories in a winter wonderland.', 35, 'images/christmas_offer.jpg', 4),
(7, 'Get a generous discount and free ski passes for two! Perfect for couples or friends looking to hit the slopes together without the extra cost. Embrace the thrill of skiing and make the most of your winter getaway.', 30, 'images/ski_for_two.jpg', 5);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `wellness`
--

CREATE TABLE `wellness` (
  `ServiceID` int(11) NOT NULL,
  `RoomType` varchar(20) DEFAULT NULL,
  `TherapistRequired` tinyint(1) DEFAULT NULL,
  `TreatmentType` varchar(20) DEFAULT NULL,
  `Duration` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `wellness`
--

INSERT INTO `wellness` (`ServiceID`, `RoomType`, `TherapistRequired`, `TreatmentType`, `Duration`) VALUES
(2, 'Spa Facilitties ', 1, 'Body', '1 hour'),
(9, 'Spa Section', 1, 'Facial', '1 hour'),
(10, 'Sauna Section', 0, 'Heat Therapy', '1 hour'),
(11, 'Outdoors', 0, 'hydrotherapy', '45 per session');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `activity`
--
ALTER TABLE `activity`
  ADD UNIQUE KEY `ServiceID` (`ServiceID`);

--
-- Ευρετήρια για πίνακα `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`AdminID`);

--
-- Ευρετήρια για πίνακα `book_service`
--
ALTER TABLE `book_service`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `fk_customer` (`FK1_CustomerID`),
  ADD KEY `fk_service` (`FK2_ServiceID`);

--
-- Ευρετήρια για πίνακα `combination`
--
ALTER TABLE `combination`
  ADD PRIMARY KEY (`RoomID`,`SpecialOfferID`),
  ADD KEY `SpecialOfferID` (`SpecialOfferID`);

--
-- Ευρετήρια για πίνακα `culinary_experience`
--
ALTER TABLE `culinary_experience`
  ADD UNIQUE KEY `ServiceID` (`ServiceID`);

--
-- Ευρετήρια για πίνακα `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Ευρετήρια για πίνακα `makes_simple_resrv`
--
ALTER TABLE `makes_simple_resrv`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `FK1_CustomerID` (`FK1_CustomerID`),
  ADD KEY `FK2_RoomID` (`FK2_RoomID`);

--
-- Ευρετήρια για πίνακα `makes_special_resrv`
--
ALTER TABLE `makes_special_resrv`
  ADD PRIMARY KEY (`ReservationID`),
  ADD KEY `FK1_CustomerID` (`FK1_CustomerID`),
  ADD KEY `FK2_RoomID` (`FK2_RoomID`),
  ADD KEY `FK3_SpecialOfferID` (`FK3_SpecialOfferID`);

--
-- Ευρετήρια για πίνακα `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomID`);

--
-- Ευρετήρια για πίνακα `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Ευρετήρια για πίνακα `special_offer`
--
ALTER TABLE `special_offer`
  ADD PRIMARY KEY (`SpecialOfferID`),
  ADD KEY `ServiceID` (`ServiceID`);

--
-- Ευρετήρια για πίνακα `wellness`
--
ALTER TABLE `wellness`
  ADD UNIQUE KEY `ServiceID` (`ServiceID`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT για πίνακα `book_service`
--
ALTER TABLE `book_service`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT για πίνακα `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `makes_simple_resrv`
--
ALTER TABLE `makes_simple_resrv`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT για πίνακα `makes_special_resrv`
--
ALTER TABLE `makes_special_resrv`
  MODIFY `ReservationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT για πίνακα `room`
--
ALTER TABLE `room`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT για πίνακα `service`
--
ALTER TABLE `service`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT για πίνακα `special_offer`
--
ALTER TABLE `special_offer`
  MODIFY `SpecialOfferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `service` (`ServiceID`);

--
-- Περιορισμοί για πίνακα `book_service`
--
ALTER TABLE `book_service`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`FK1_CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_service` FOREIGN KEY (`FK2_ServiceID`) REFERENCES `service` (`ServiceID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `combination`
--
ALTER TABLE `combination`
  ADD CONSTRAINT `combination_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `room` (`RoomID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `combination_ibfk_2` FOREIGN KEY (`SpecialOfferID`) REFERENCES `special_offer` (`SpecialOfferID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `culinary_experience`
--
ALTER TABLE `culinary_experience`
  ADD CONSTRAINT `culinary_experience_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `service` (`ServiceID`);

--
-- Περιορισμοί για πίνακα `makes_simple_resrv`
--
ALTER TABLE `makes_simple_resrv`
  ADD CONSTRAINT `makes_simple_resrv_ibfk_1` FOREIGN KEY (`FK1_CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `makes_simple_resrv_ibfk_2` FOREIGN KEY (`FK2_RoomID`) REFERENCES `room` (`RoomID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `makes_special_resrv`
--
ALTER TABLE `makes_special_resrv`
  ADD CONSTRAINT `makes_special_resrv_ibfk_1` FOREIGN KEY (`FK1_CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `makes_special_resrv_ibfk_2` FOREIGN KEY (`FK2_RoomID`) REFERENCES `room` (`RoomID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `makes_special_resrv_ibfk_3` FOREIGN KEY (`FK3_SpecialOfferID`) REFERENCES `special_offer` (`SpecialOfferID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `special_offer`
--
ALTER TABLE `special_offer`
  ADD CONSTRAINT `special_offer_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `service` (`ServiceID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `wellness`
--
ALTER TABLE `wellness`
  ADD CONSTRAINT `wellness_ibfk_1` FOREIGN KEY (`ServiceID`) REFERENCES `service` (`ServiceID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
