<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Page</title>
    <style>
   body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
}

.container {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.abt{
    background-color: blueviolet;
}


h1,
h3 {
  text-align: center;
  color: blue;
  background-color: cyan;
}

h1 {
  margin-top: 40px;
  font-size: 36px;
  color: #f4f4f4;
}

h3 {
  margin-bottom: 20px;
  font-size: 18px;
  line-height: 1.6;
}

.team-members {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.team-member {
  width: calc(33.33% - 40px);
  margin: 20px;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}
.team-member img {
            max-width: 100%; /* Ensure the image doesn't overflow its container */
            height: auto;
            border-radius: 50%; /* Make the image circular */
            margin-bottom: 15px;
        }


.team-member:hover {
  transform: scale(1.05);
}

.facilities-list,
.values-list {
  padding-left: 20px;
  text-align: left;
}

.facilities-list li,
.values-list li {
  margin-bottom: 10px;
  list-style-type: none;
  position: relative;
}

.facilities-list li::before,
.values-list li::before {
  content: "•";
  color: #45a049;
  font-weight: bold;
  display: inline-block;
  width: 1em;
  margin-left: -1em;
  position: absolute;
  left: 0;
}

.facilities-list {
  padding-left: 20px;
}

.values-list {
  padding-left: 20px;
}
    </style>
</head>

<body>

    <div class="container">
        <h1 class="abt">About Us</h1>
        <h3>Welcome to Vagabond, a premier hostel management system designed to provide a comfortable and convenient living experience for our residents. Our system is dedicated to making your stay with us as smooth and enjoyable as possible.</h3>

        <h1 style=" background-color: blueviolet;">Our Mission</h1>
        <h3>Our mission is to provide a safe, secure, and welcoming environment for our residents, while also ensuring that our hostel is well-maintained and efficiently managed. We strive to create a sense of community among our residents, and to provide them with the resources and support they need to succeed.</h3>

        <h1  style=" background-color: blueviolet;">Our Vision</h1>
        <h3>Our vision is to be the leading hostel management system in the region, known for our commitment to excellence, our attention to detail, and our dedication to providing exceptional customer service. We aim to create a hostel experience that is second to none, and to make Vagabond the go-to choice for students, travelers, and professionals alike.</h3>

        <h1  style=" background-color: blueviolet;">Our Team</h1>
        <div class="team-members" >
            <div class="team-member" >
            <img src="pictures/gimli.png" alt="Owner">
                <h3>Deepak Poudel</h3>
                <p>With over 10 years of experience in hostel management, Deepak is responsible for overseeing the day-to-day operations of the hostel.</p>
            </div>
            <div class="team-member">
            <img src="pictures/pew.jpg" alt="Assistant Manager">
                <h3>Assistant Manager</h3>
                <p>Pewdiepie is responsible for managing the front desk and ensuring that our residents have a smooth and enjoyable stay.</p>
            </div>
            <div class="team-member">
            <img src="pictures/dave2d.jpg" alt="Maintenance Manager">
                <h3>Maintenance Manager</h3>
                <p>Dave2D is responsible for ensuring that the hostel is well-maintained and that any issues are addressed promptly.</p>
            </div>
        </div>

        <h1  style=" background-color: blueviolet;">Our Facilities</h1>
        <ul class="facilities-list">
            <li>Spacious and well-furnished rooms</li>
            <li>24/7 security and CCTV surveillance</li>
            <li>High-speed internet access</li>
            <li>Laundry facilities</li>
            <li>Common lounge areas</li>
            <li>Kitchen facilities</li>
            <li>On-site parking</li>
        </ul>

        <h1  style=" background-color: blueviolet;">Our Values</h1>
        <ul class="values-list">
            <li>Excellence: We strive to provide exceptional service and to continually improve our operations.</li>
            <li>Integrity: We are honest and transparent in all of our dealings.</li>
            <li>Respect: We treat our residents with respect and dignity.</li>
            <li>Community: We believe in creating a sense of community among our residents.</li>
            <li>Sustainability: We are committed to reducing our environmental impact and to promoting sustainable practices.</li>
        </ul>
    </div>

</body>

</html>