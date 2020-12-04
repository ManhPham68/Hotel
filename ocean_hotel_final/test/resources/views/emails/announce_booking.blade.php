<!DOCTYPE html>
<html>
<head>
    <title>OCEAN HOTEL</title>
</head>
<body>
<p>
    Hello {{$title}}. {{$name}}!
</p>
<h1>Your booking id is {{$booking->id}}</h1>
<h2>
    Information of your booking
</h2>
    <p>
        <span>#                                :</span>
        <span> {{$booking -> id}} </span>
    </p>
    <p>
        <span>Name                              :</span>
        <span> {{$booking->Guest->name}} </span>
    </p>
    <p>
        <span>Age                               :</span>
        <span> {{$booking->Guest->age}} </span>
    </p>
    <p>
        <span>Telephone                         :</span>
        <span> {{$booking->Guest->telephone}}   :</span>
    </p>
    <p>
        <span>Room Book                         :</span>
        <span> {{$booking->Room->name}} </span>
    </p>
    <p>
        <span>Quantity                          :</span>
        <span> {{$booking->quantity}} </span>
    </p>
    <p>
        <span>Check in                          :</span>
        <span> {{date('d/m/Y',strtotime($booking->check_in))}} </span>
    </p>
    <p>
        <span>Check out                         :</span>
        <span> {{date('d/m/Y',strtotime($booking->check_out))}} </span>
    </p>
    <p>
        <span>Total_cost                        :</span>
        <span> {{$booking->RoomBooking->total_cost}}$</span>
    </p>
<p>
    Please wating while we can confirm your order !
</p>

<p>We allway exspect pe presentation of you. Let go to pe Ocean Hotel to enjoy the life with pascinating
    lanscapes and there are many interesting things that are wating you explore with us !</p>
<p>
    Thank you and good a nice day <3
</p>

</body>
</html>

