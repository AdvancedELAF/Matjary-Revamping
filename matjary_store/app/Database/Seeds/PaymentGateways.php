<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentGateways extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        =>    'ZidPay',
                'description' =>    'ZidPay. Payment solutions tailored for modern retailers where they can with one click can activate any payment services: Visa, MasterCard, and Apple Pay.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'Tap',
                'description' =>    'Tap simplifies payments for businesses by unifying and connecting all regional and international payment methods your customers love securely under a single integration.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'PayFort',
                'description' =>    'PayFort makes online transactions safe and secure for Arab sellers and buyers, offering a comprehensive suite of payment systems customized to the regions requirements and perfectly suited to Arab online shopping lifestyles and trends.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'HayperPay',
                'description' =>    'HyperPay is a robust online payment gateway driving the future of cashless payments in the MENA region. We process millions of transactions a year for thousands of merchants across almost every industry. Running an internet business has never been easier.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'PayTabs',
                'description' =>    'PayTabs is a secure payment processing company which facilitates payments for startups, entrepreneurs, SME, merchants and super merchants by providing ecommerce, mobile commerce and social commerce invoicing and payment solutions.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'Moyasar',
                'description' =>    'A comprehensive set of payment solutions that allows you to easily accept and track your transactions. Trusted by different industries.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'Tamara',
                'description' =>    'Buy now and pay later. No immediate payment needed. Tamara is a solution for brick and mortar and e-commerce players in the GCC. We are a regional startup with a bold vision and a global experienced team. We provide a Buy Now Pay Later solution in Saudi Arabia and the UAE.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'Tabby',
                'description' =>    'Tabby lets you split your purchases into 4 interest-free payments, online and in-store. Pay later with Tabby. Get it now, pay later. Shop for what you love now and spread out your payments. No interest or fees.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'stc pay',
                'description' =>    'STC Pay a secure digital wallet that empowers thousands of customers to take full control and manage their finances anytime, from anywhere. It enables sending, receiving and managing money directly through a mobile app.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'apple pay',
                'description' =>    'Apple Pay provides an easy and secure way to make payments in your iOS, iPadOS, and watchOS apps, and on websites in Safari. And now, Apple Pay can also be used in Messages for Business and in iMessage extensions.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'spotii',
                'description' =>    'Spotii is a technology-enabled payments solution that empowers your Shoppers to Shop Now and Pay Later with absolutely zero interest and processing fees across four equal instalments. Offering Shop Now and Pay Later options have been shown to increase average basket size by 50-70%, increase conversion rates by 20-40%, reduce refunds by up to 30%, reduce the need for discounting and raise customer loyalty.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'paypal',
                'description' =>    'Payflow Gateway is PayPal secure and open payment gateway. Using the Payflow Gateway APIs, merchants can process debit and credit card payments, PayPal, PayPal Credit®, authorizations, captures, and credit voids. PayPal Payments Pro internally utilizes Payflow Gateway and its API, providing the same features.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ],
            [
                'name'        =>    'visa,master card,mada',
                'description' =>    'Visa itself is s credit card processing network. Its cards (credit, debit, prepaid, gift) are accepted by merchants in over 200 countries and areas across the globe. Another credit card processing networks are Mastercard, American Express, and Discover. Financial institutions (like banks) choose Visa as a partner.',
                'is_active'   =>    1,
                'created_at'  =>    DATETIME,
                'updated_at'  =>    DATETIME
            ]
            
        ];

        /* Using Query Builder */
        $this->db->table('paymentgateways')->insertBatch($data);

    }
}

?>