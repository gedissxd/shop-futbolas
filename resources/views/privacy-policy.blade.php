<x-layout title="Privacy Policy">
    <div class="container mx-auto px-6 py-12 max-w-4xl">
        <div class="prose prose-lg max-w-none dark:prose-invert">
            <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">Privacy Policy</h1>
            
            <p class="mb-8 text-gray-600 dark:text-gray-300">
                <strong>Last updated:</strong> {{ date('F j, Y') }}
            </p>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">1. Introduction</h2>
                <p class="mb-4 text-gray-700 dark:text-gray-300">
                    Welcome to {{ config('app.name') }}. We respect your privacy and are committed to protecting your personal data. 
                    This privacy policy explains how we collect, use, and protect your information when you use our website and services.
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    This policy complies with the General Data Protection Regulation (GDPR) and other applicable data protection laws.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">2. Information We Collect</h2>
                
                <h3 class="text-xl font-medium mb-3 text-gray-800 dark:text-gray-200">2.1 Personal Information</h3>
                <p class="mb-4 text-gray-700 dark:text-gray-300">We may collect the following personal information:</p>
                <ul class="list-disc list-inside mb-4 space-y-1 text-gray-700 dark:text-gray-300">
                    <li>Name and contact information (email, phone, address)</li>
                    <li>Account credentials (username, password)</li>
                    <li>Payment information (billing address, payment method details)</li>
                    <li>Order history and preferences</li>
                    <li>Communication records with our customer service</li>
                </ul>

                <h3 class="text-xl font-medium mb-3 text-gray-800 dark:text-gray-200">2.2 Technical Information</h3>
                <ul class="list-disc list-inside mb-4 space-y-1 text-gray-700 dark:text-gray-300">
                    <li>IP address and browser information</li>
                    <li>Device information and operating system</li>
                    <li>Website usage data and analytics</li>
                    <li>Cookies and similar tracking technologies</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">3. How We Use Your Information</h2>
                <p class="mb-4 text-gray-700 dark:text-gray-300">We use your personal information for the following purposes:</p>
                <ul class="list-disc list-inside mb-4 space-y-1 text-gray-700 dark:text-gray-300">
                    <li>Processing and fulfilling your orders</li>
                    <li>Managing your account and providing customer support</li>
                    <li>Sending order confirmations and updates</li>
                    <li>Improving our website and services</li>
                    <li>Marketing communications (with your consent)</li>
                    <li>Preventing fraud and ensuring security</li>
                    <li>Complying with legal obligations</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">4. Legal Basis for Processing</h2>
                <p class="mb-4 text-gray-700 dark:text-gray-300">Under GDPR, we process your personal data based on:</p>
                <ul class="list-disc list-inside mb-4 space-y-1 text-gray-700 dark:text-gray-300">
                    <li><strong>Contract performance:</strong> To fulfill orders and provide services</li>
                    <li><strong>Legitimate interests:</strong> To improve our services and prevent fraud</li>
                    <li><strong>Consent:</strong> For marketing communications and non-essential cookies</li>
                    <li><strong>Legal obligation:</strong> To comply with tax and accounting requirements</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">5. Information Sharing</h2>
                <p class="mb-4 text-gray-700 dark:text-gray-300">We may share your information with:</p>
                <ul class="list-disc list-inside mb-4 space-y-1 text-gray-700 dark:text-gray-300">
                    <li><strong>Service providers:</strong> Payment processors, shipping companies, hosting providers</li>
                    <li><strong>Legal authorities:</strong> When required by law or to protect our rights</li>
                    <li><strong>Business transfers:</strong> In case of merger, acquisition, or asset sale</li>
                </ul>
                <p class="text-gray-700 dark:text-gray-300">
                    We do not sell, rent, or trade your personal information to third parties for their marketing purposes.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">6. Data Security</h2>
                <p class="mb-4 text-gray-700 dark:text-gray-300">
                    We implement appropriate technical and organizational measures to protect your personal data against 
                    unauthorized access, alteration, disclosure, or destruction. These measures include:
                </p>
                <ul class="list-disc list-inside mb-4 space-y-1 text-gray-700 dark:text-gray-300">
                    <li>Encryption of sensitive data</li>
                    <li>Secure servers and regular security updates</li>
                    <li>Access controls and staff training</li>
                    <li>Regular security assessments</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">7. Data Retention</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    We retain your personal data only for as long as necessary to fulfill the purposes outlined in this policy 
                    or as required by law. Account information is typically retained for 7 years after account closure for 
                    legal and tax purposes.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">8. Your Rights</h2>
                <p class="mb-4 text-gray-700 dark:text-gray-300">Under GDPR, you have the following rights:</p>
                <ul class="list-disc list-inside mb-4 space-y-1 text-gray-700 dark:text-gray-300">
                    <li><strong>Right of access:</strong> Request copies of your personal data</li>
                    <li><strong>Right to rectification:</strong> Correct inaccurate or incomplete data</li>
                    <li><strong>Right to erasure:</strong> Request deletion of your data ("right to be forgotten")</li>
                    <li><strong>Right to restrict processing:</strong> Limit how we use your data</li>
                    <li><strong>Right to data portability:</strong> Receive your data in a portable format</li>
                    <li><strong>Right to object:</strong> Object to processing based on legitimate interests</li>
                    <li><strong>Right to withdraw consent:</strong> Withdraw consent for marketing communications</li>
                </ul>
                <p class="text-gray-700 dark:text-gray-300">
                    To exercise these rights, please contact us using the information provided below.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">9. Cookies</h2>
                <p class="mb-4 text-gray-700 dark:text-gray-300">
                    We use cookies and similar technologies to enhance your browsing experience. You can manage your 
                    cookie preferences through your browser settings. Essential cookies required for website functionality 
                    cannot be disabled.
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    For more information about cookies, please see our Cookie Policy.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">10. International Transfers</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Your data may be transferred to and processed in countries outside the European Economic Area (EEA). 
                    We ensure such transfers are protected by appropriate safeguards, such as adequacy decisions or 
                    standard contractual clauses.
                </p>
            </section>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">11. Children's Privacy</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Our services are not intended for children under 16 years of age. We do not knowingly collect 
                    personal information from children under 16. If you believe we have collected such information, 
                    please contact us immediately.
                </p>
            </section>
        </div>
    </div>
</x-layout>