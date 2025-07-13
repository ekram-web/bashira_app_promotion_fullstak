<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\About;
use App\Models\Hero;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\Contact;
use App\Models\Offer;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@basirah.com',
            'password' => bcrypt('password123'),
        ]);

        // Create About data
        About::create([
            'title' => 'WHO WE ARE',
            'description' => 'Basirah Institute is a leading Qur\'anic education platform dedicated to empowering the next generation with authentic knowledge, modern tools, and a global community. Our mission is to make learning accessible, engaging, and relevant for everyone, everywhere. We blend tradition with technology to inspire and connect students and teachers worldwide.',
            'image' => '/images/ustaz/about.JPG',
            'mission' => 'To make Qur\'anic education accessible, engaging, and relevant for everyone, everywhere.',
            'vision' => 'To be the leading global platform for Qur\'anic education and Islamic learning.',
            'values' => [
                'Authenticity' => 'We maintain the highest standards of Islamic scholarship and tradition.',
                'Innovation' => 'We embrace modern technology to enhance learning experiences.',
                'Community' => 'We foster a supportive global community of learners and teachers.',
                'Excellence' => 'We strive for excellence in everything we do.'
            ]
        ]);

        // Create Hero slides
        Hero::create([
            'title' => 'Empower Your Qur\'anic Journey',
            'subtitle' => 'Learn, connect, and grow with Basirah Institute\'s modern tools and global community.',
            'background_gradient' => 'linear-gradient(120deg, #042048 60%, #01AD88 100%)',
            'image' => '/images/quran.png',
            'order' => 1,
            'is_active' => true
        ]);

        Hero::create([
            'title' => 'Expert Teachers, Authentic Resources',
            'subtitle' => 'Access certified scholars, interactive lessons, and a supportive learning environment—anytime, anywhere.',
            'background_gradient' => 'linear-gradient(120deg, #042048 60%, #01AD88 100%)',
            'image' => '/images/quran.png',
            'order' => 2,
            'is_active' => true
        ]);

        Hero::create([
            'title' => 'Interactive Learning, Real Progress',
            'subtitle' => 'Track your Qur\'anic studies, join live classes, and connect with a global community—all in one app.',
            'background_gradient' => 'linear-gradient(120deg, #042048 60%, #01AD88 100%)',
            'image' => '/images/quran.png',
            'order' => 3,
            'is_active' => true
        ]);

        // Create Promotion data
        Promotion::create([
            'title' => 'Get the Basirah App',
            'subtitle' => 'Experience seamless learning and teaching—anytime, anywhere.',
            'app_store_url' => 'https://apps.apple.com/',
            'play_store_url' => 'https://play.google.com/',
            'qr_code_image' => '/images/qr.jpg',
            'phone_image' => '/images/pho.png',
            'is_active' => true
        ]);

        // Create Offers
        $offers = [
            [
                'title' => 'Simplified',
                'subtitle' => 'Complex tasks are now simple',
                'description' => 'Our platform makes complex Qur\'anic learning accessible to everyone, regardless of their background or experience level.'
            ],
            [
                'title' => 'Boost Productivity',
                'subtitle' => 'Perform Tasks in less time',
                'description' => 'Efficient learning tools and structured courses help you achieve your goals faster and more effectively.'
            ],
            [
                'title' => 'Facilitated learning',
                'subtitle' => 'Train anyone from anywhere',
                'description' => 'Our global platform connects learners and teachers worldwide, breaking down geographical barriers.'
            ],
            [
                'title' => 'Support',
                'subtitle' => 'Now it\'s 24/7 support',
                'description' => 'Round-the-clock assistance ensures you never feel alone in your learning journey.'
            ]
        ];

        foreach ($offers as $offer) {
            Offer::create($offer);
        }

        // Create Reviews
        $reviews = [
            [
                'name' => 'Fatima Ali',
                'role' => 'Student',
                'text' => 'Basirah Institute has transformed my understanding of the Qur\'an. The resources and teachers are amazing!',
                'image' => '/images/ustaz/ustaz_k.png',
                'rating' => 5,
                'order' => 1
            ],
            [
                'name' => 'Dr. Ahmed Yusuf',
                'role' => 'Scholar',
                'text' => 'A wonderful platform for both beginners and advanced learners. Highly recommended for anyone seeking knowledge.',
                'image' => '/images/ustaz/ustaz_k.png',
                'rating' => 5,
                'order' => 2
            ],
            [
                'name' => 'Mohammed Salim',
                'role' => 'Parent',
                'text' => 'My children love the interactive lessons. The app is easy to use and very educational.',
                'image' => '/images/ustaz/ustaz_k.png',
                'rating' => 5,
                'order' => 3
            ],
            [
                'name' => 'Aisha Noor',
                'role' => 'Teacher',
                'text' => 'The app\'s features make teaching so much easier and more interactive. My students are more engaged than ever!',
                'image' => '/images/ustaz/ustaz_k.png',
                'rating' => 5,
                'order' => 4
            ],
            [
                'name' => 'Omar Khalid',
                'role' => 'Student',
                'text' => 'I love the live classes and the supportive community. Basirah is the best!',
                'image' => '/images/ustaz/ustaz_k.png',
                'rating' => 5,
                'order' => 5
            ],
            [
                'name' => 'Layla Hassan',
                'role' => 'Parent',
                'text' => 'Basirah\'s resources are top-notch. My kids are learning so much!',
                'image' => '/images/ustaz/ustaz_k.png',
                'rating' => 5,
                'order' => 6
            ]
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }

        // Create Contact information
        Contact::create([
            'address' => '123 Islamic Center Street, Cairo, Egypt',
            'phone' => '+20 123 456 7890',
            'email' => 'info@basirah.com',
            'website' => 'https://basirah.com',
            'map_embed_url' => 'https://www.openstreetmap.org/export/embed.html?bbox=31.2357%2C30.0444%2C31.2457%2C30.0544&amp;layer=mapnik',
            'social_media' => [
                'facebook' => 'https://facebook.com/basirah',
                'twitter' => 'https://twitter.com/basirah',
                'instagram' => 'https://instagram.com/basirah',
                'youtube' => 'https://youtube.com/basirah'
            ],
            'working_hours' => [
                'monday' => '9:00 AM - 6:00 PM',
                'tuesday' => '9:00 AM - 6:00 PM',
                'wednesday' => '9:00 AM - 6:00 PM',
                'thursday' => '9:00 AM - 6:00 PM',
                'friday' => '9:00 AM - 1:00 PM',
                'saturday' => '10:00 AM - 4:00 PM',
                'sunday' => 'Closed'
            ]
        ]);
    }
}
