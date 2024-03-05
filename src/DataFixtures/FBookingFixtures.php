<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Booking;
use DateTime;

class FBookingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $booking = new Booking();

        $booking->setDateBooking(new DateTime('now'));
        $booking->setStatus(false);
        $manager->persist($booking);

        $manager->flush();
        echo '*** booking persisted ***';
    }
}