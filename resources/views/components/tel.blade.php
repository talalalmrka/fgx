@props([
    'id' => uniqid('input-'),
    'type' => 'text',
    'name' => null,
    'icon' => null,
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'autofocus' => false,
    'autocomplete' => null,
    'required' => false,
    'error' => null,
    'disabled' => false,
    'rounded' => 'lg',
    'atts' => [],
    'startIcon' => null,
    'endIcon' => null,
    'info' => null,
    'isPassword' => $type == 'password',
    'size' => 'normal',
])
@error($id)
    @php
        $error = $message;
    @endphp
@enderror
<x-form.label for="{{ $id }}" :icon="$icon" :required="$required" :error="$error">
    {!! $label ?? $slot !!}
</x-form.label>
<div x-data="{
    allOptions: [
        { label: 'Afghanistan', value: 'Afghanistan', iso: 'af', phoneCode: '+93' },
        { label: 'Albania', value: 'Albania', iso: 'al', phoneCode: '+355' },
        { label: 'Algeria', value: 'Algeria', iso: 'dz', phoneCode: '+213' },
        { label: 'Andorra', value: 'Andorra', iso: 'ad', phoneCode: '+376' },
        { label: 'Angola', value: 'Angola', iso: 'ao', phoneCode: '+244' },
        { label: 'Anguilla', value: 'Anguilla', iso: 'ai', phoneCode: '+1-264' },
        { label: 'Antigua and Barbuda', value: 'Antigua and Barbuda', iso: 'ag', phoneCode: '+1-268' },
        { label: 'Argentina', value: 'Argentina', iso: 'ar', phoneCode: '+54' },
        { label: 'Armenia', value: 'Armenia', iso: 'am', phoneCode: '+374' },
        { label: 'Aruba', value: 'Aruba', iso: 'aw', phoneCode: '+297' },
        { label: 'Australia', value: 'Australia', iso: 'au', phoneCode: '+61' },
        { label: 'Austria', value: 'Austria', iso: 'at', phoneCode: '+43' },
        { label: 'Azerbaijan', value: 'Azerbaijan', iso: 'az', phoneCode: '+994' },
        { label: 'Bahamas', value: 'Bahamas', iso: 'bs', phoneCode: '+1-242' },
        { label: 'Bahrain', value: 'Bahrain', iso: 'bh', phoneCode: '+973' },
        { label: 'Bangladesh', value: 'Bangladesh', iso: 'bd', phoneCode: '+880' },
        { label: 'Barbados', value: 'Barbados', iso: 'bb', phoneCode: '+1-246' },
        { label: 'Belarus', value: 'Belarus', iso: 'by', phoneCode: '+375' },
        { label: 'Belgium', value: 'Belgium', iso: 'be', phoneCode: '+32' },
        { label: 'Belize', value: 'Belize', iso: 'bz', phoneCode: '+501' },
        { label: 'Benin', value: 'Benin', iso: 'bj', phoneCode: '+229' },
        { label: 'Bermuda', value: 'Bermuda', iso: 'bm', phoneCode: '+1-441' },
        { label: 'Bhutan', value: 'Bhutan', iso: 'bt', phoneCode: '+975' },
        { label: 'Bolivia', value: 'Bolivia', iso: 'bo', phoneCode: '+591' },
        { label: 'Bosnia and Herzegovina', value: 'Bosnia and Herzegovina', iso: 'ba', phoneCode: '+387' },
        { label: 'Botswana', value: 'Botswana', iso: 'bw', phoneCode: '+267' },
        { label: 'Brazil', value: 'Brazil', iso: 'br', phoneCode: '+55' },
        { label: 'British Indian Ocean Territory', value: 'British Indian Ocean Territory', iso: 'io', phoneCode: '+246' },
        { label: 'British Virgin Islands', value: 'British Virgin Islands', iso: 'vg', phoneCode: '+1-284' },
        { label: 'Brunei', value: 'Brunei', iso: 'bn', phoneCode: '+673' },
        { label: 'Bulgaria', value: 'Bulgaria', iso: 'bg', phoneCode: '+359' },
        { label: 'Burkina Faso', value: 'Burkina Faso', iso: 'bf', phoneCode: '+226' },
        { label: 'Burundi', value: 'Burundi', iso: 'bi', phoneCode: '+257' },
        { label: 'Cambodia', value: 'Cambodia', iso: 'kh', phoneCode: '+855' },
        { label: 'Cameroon', value: 'Cameroon', iso: 'cm', phoneCode: '+237' },
        { label: 'Canada', value: 'Canada', iso: 'ca', phoneCode: '+1' },
        { label: 'Cape Verde', value: 'Cape Verde', iso: 'cv', phoneCode: '+238' },
        { label: 'Cayman Islands', value: 'Cayman Islands', iso: 'ky', phoneCode: '+1-345' },
        { label: 'Central African Republic', value: 'Central African Republic', iso: 'cf', phoneCode: '+236' },
        { label: 'Chad', value: 'Chad', iso: 'td', phoneCode: '+235' },
        { label: 'Chile', value: 'Chile', iso: 'cl', phoneCode: '+56' },
        { label: 'China', value: 'China', iso: 'cn', phoneCode: '+86' },
        { label: 'Colombia', value: 'Colombia', iso: 'co', phoneCode: '+57' },
        { label: 'Comoros', value: 'Comoros', iso: 'km', phoneCode: '+269' },
        { label: 'Congo (Brazzaville)', value: 'Congo (Brazzaville)', iso: 'cg', phoneCode: '+242' },
        { label: 'Congo (Kinshasa)', value: 'Congo (Kinshasa)', iso: 'cd', phoneCode: '+243' },
        { label: 'Cook Islands', value: 'Cook Islands', iso: 'ck', phoneCode: '+682' },
        { label: 'Costa Rica', value: 'Costa Rica', iso: 'cr', phoneCode: '+506' },
        { label: 'Croatia', value: 'Croatia', iso: 'hr', phoneCode: '+385' },
        { label: 'Cuba', value: 'Cuba', iso: 'cu', phoneCode: '+53' },
        { label: 'Curaçao', value: 'Curaçao', iso: 'cw', phoneCode: '+599' },
        { label: 'Cyprus', value: 'Cyprus', iso: 'cy', phoneCode: '+357' },
        { label: 'Czechia', value: 'Czechia', iso: 'cz', phoneCode: '+420' },
        { label: 'Denmark', value: 'Denmark', iso: 'dk', phoneCode: '+45' },
        { label: 'Djibouti', value: 'Djibouti', iso: 'dj', phoneCode: '+253' },
        { label: 'Dominica', value: 'Dominica', iso: 'dm', phoneCode: '+1-767' },
        { label: 'Dominican Republic', value: 'Dominican Republic', iso: 'do', phoneCode: '+1-809' },
        { label: 'Ecuador', value: 'Ecuador', iso: 'ec', phoneCode: '+593' },
        { label: 'Egypt', value: 'Egypt', iso: 'eg', phoneCode: '+20' },
        { label: 'El Salvador', value: 'El Salvador', iso: 'sv', phoneCode: '+503' },
        { label: 'England', value: 'England', iso: 'gb-eng', phoneCode: '+44' },
        { label: 'Equatorial Guinea', value: 'Equatorial Guinea', iso: 'gq', phoneCode: '+240' },
        { label: 'Eritrea', value: 'Eritrea', iso: 'er', phoneCode: '+291' },
        { label: 'Estonia', value: 'Estonia', iso: 'ee', phoneCode: '+372' },
        { label: 'Eswatini (Swaziland)', value: 'Eswatini (Swaziland)', iso: 'sz', phoneCode: '+268' },
        { label: 'Ethiopia', value: 'Ethiopia', iso: 'et', phoneCode: '+251' },
        { label: 'Falkland Islands (Islas Malvinas)', value: 'Falkland Islands (Islas Malvinas)', iso: 'fk', phoneCode: '+500' },
        { label: 'Faroe Islands', value: 'Faroe Islands', iso: 'fo', phoneCode: '+298' },
        { label: 'Fiji', value: 'Fiji', iso: 'fj', phoneCode: '+679' },
        { label: 'Finland', value: 'Finland', iso: 'fi', phoneCode: '+358' },
        { label: 'France', value: 'France', iso: 'fr', phoneCode: '+33' },
        { label: 'French Guiana', value: 'French Guiana', iso: 'gf', phoneCode: '+594' },
        { label: 'French Polynesia', value: 'French Polynesia', iso: 'pf', phoneCode: '+689' },
        { label: 'French Southern and Antarctic Lands', value: 'French Southern and Antarctic Lands', iso: 'tf', phoneCode: '+262' },
        { label: 'Gabon', value: 'Gabon', iso: 'ga', phoneCode: '+241' },
        { label: 'Gambia', value: 'Gambia', iso: 'gm', phoneCode: '+220' },
        { label: 'Georgia', value: 'Georgia', iso: 'ge', phoneCode: '+995' },
        { label: 'Germany', value: 'Germany', iso: 'de', phoneCode: '+49' },
        { label: 'Ghana', value: 'Ghana', iso: 'gh', phoneCode: '+233' },
        { label: 'Gibraltar', value: 'Gibraltar', iso: 'gi', phoneCode: '+350' },
        { label: 'Greece', value: 'Greece', iso: 'gr', phoneCode: '+30' },
        { label: 'Greenland', value: 'Greenland', iso: 'gl', phoneCode: '+299' },
        { label: 'Grenada', value: 'Grenada', iso: 'gd', phoneCode: '+1-473' },
        { label: 'Guadeloupe', value: 'Guadeloupe', iso: 'gp', phoneCode: '+590' },
        { label: 'Guam', value: 'Guam', iso: 'gu', phoneCode: '+1-671' },
        { label: 'Guatemala', value: 'Guatemala', iso: 'gt', phoneCode: '+502' },
        { label: 'Guinea', value: 'Guinea', iso: 'gn', phoneCode: '+224' },
        { label: 'Guinea-Bissau', value: 'Guinea-Bissau', iso: 'gw', phoneCode: '+245' },
        { label: 'Guyana', value: 'Guyana', iso: 'gy', phoneCode: '+592' },
        { label: 'Haiti', value: 'Haiti', iso: 'ht', phoneCode: '+509' },
        { label: 'Honduras', value: 'Honduras', iso: 'hn', phoneCode: '+504' },
        { label: 'Hong Kong', value: 'Hong Kong', iso: 'hk', phoneCode: '+852' },
        { label: 'Hungary', value: 'Hungary', iso: 'hu', phoneCode: '+36' },
        { label: 'Iceland', value: 'Iceland', iso: 'is', phoneCode: '+354' },
        { label: 'India', value: 'India', iso: 'in', phoneCode: '+91' },
        { label: 'Indonesia', value: 'Indonesia', iso: 'id', phoneCode: '+62' },
        { label: 'Iran', value: 'Iran', iso: 'ir', phoneCode: '+98' },
        { label: 'Iraq', value: 'Iraq', iso: 'iq', phoneCode: '+964' },
        { label: 'Ireland', value: 'Ireland', iso: 'ie', phoneCode: '+353' },
        { label: 'Israel', value: 'Israel', iso: 'il', phoneCode: '+972' },
        { label: 'Italy', value: 'Italy', iso: 'it', phoneCode: '+39' },
        { label: 'Ivory Coast', value: 'Ivory Coast', iso: 'ci', phoneCode: '+225' },
        { label: 'Jamaica', value: 'Jamaica', iso: 'jm', phoneCode: '+1-876' },
        { label: 'Japan', value: 'Japan', iso: 'jp', phoneCode: '+81' },
        { label: 'Jordan', value: 'Jordan', iso: 'jo', phoneCode: '+962' },
        { label: 'Kazakhstan', value: 'Kazakhstan', iso: 'kz', phoneCode: '+7' },
        { label: 'Kenya', value: 'Kenya', iso: 'ke', phoneCode: '+254' },
        { label: 'Kiribati', value: 'Kiribati', iso: 'ki', phoneCode: '+686' },
        { label: 'Kosovo', value: 'Kosovo', iso: 'xk', phoneCode: '+383' },
        { label: 'Kuwait', value: 'Kuwait', iso: 'kw', phoneCode: '+965' },
        { label: 'Kyrgyzstan', value: 'Kyrgyzstan', iso: 'kg', phoneCode: '+996' },
        { label: 'Laos', value: 'Laos', iso: 'la', phoneCode: '+856' },
        { label: 'Latvia', value: 'Latvia', iso: 'lv', phoneCode: '+371' },
        { label: 'Lebanon', value: 'Lebanon', iso: 'lb', phoneCode: '+961' },
        { label: 'Lesotho', value: 'Lesotho', iso: 'ls', phoneCode: '+266' },
        { label: 'Liberia', value: 'Liberia', iso: 'lr', phoneCode: '+231' },
        { label: 'Libya', value: 'Libya', iso: 'ly', phoneCode: '+218' },
        { label: 'Liechtenstein', value: 'Liechtenstein', iso: 'li', phoneCode: '+423' },
        { label: 'Lithuania', value: 'Lithuania', iso: 'lt', phoneCode: '+370' },
        { label: 'Luxembourg', value: 'Luxembourg', iso: 'lu', phoneCode: '+352' },
        { label: 'Macau', value: 'Macau', iso: 'mo', phoneCode: '+853' },
        { label: 'Madagascar', value: 'Madagascar', iso: 'mg', phoneCode: '+261' },
        { label: 'Malawi', value: 'Malawi', iso: 'mw', phoneCode: '+265' },
        { label: 'Malaysia', value: 'Malaysia', iso: 'my', phoneCode: '+60' },
        { label: 'Maldives', value: 'Maldives', iso: 'mv', phoneCode: '+960' },
        { label: 'Mali', value: 'Mali', iso: 'ml', phoneCode: '+223' },
        { label: 'Malta', value: 'Malta', iso: 'mt', phoneCode: '+356' },
        { label: 'Marshall Islands', value: 'Marshall Islands', iso: 'mh', phoneCode: '+692' },
        { label: 'Martinique', value: 'Martinique', iso: 'mq', phoneCode: '+596' },
        { label: 'Mauritania', value: 'Mauritania', iso: 'mr', phoneCode: '+222' },
        { label: 'Mauritius', value: 'Mauritius', iso: 'mu', phoneCode: '+230' },
        { label: 'Mexico', value: 'Mexico', iso: 'mx', phoneCode: '+52' },
        { label: 'Micronesia', value: 'Micronesia', iso: 'fm', phoneCode: '+691' },
        { label: 'Moldova', value: 'Moldova', iso: 'md', phoneCode: '+373' },
        { label: 'Monaco', value: 'Monaco', iso: 'mc', phoneCode: '+377' },
        { label: 'Mongolia', value: 'Mongolia', iso: 'mn', phoneCode: '+976' },
        { label: 'Montenegro', value: 'Montenegro', iso: 'me', phoneCode: '+382' },
        { label: 'Montserrat', value: 'Montserrat', iso: 'ms', phoneCode: '+1-664' },
        { label: 'Morocco', value: 'Morocco', iso: 'ma', phoneCode: '+212' },
        { label: 'Mozambique', value: 'Mozambique', iso: 'mz', phoneCode: '+258' },
        { label: 'Myanmar (Burma)', value: 'Myanmar (Burma)', iso: 'mm', phoneCode: '+95' },
        { label: 'Namibia', value: 'Namibia', iso: 'na', phoneCode: '+264' },
        { label: 'Nauru', value: 'Nauru', iso: 'nr', phoneCode: '+674' },
        { label: 'Nepal', value: 'Nepal', iso: 'np', phoneCode: '+977' },
        { label: 'Netherlands', value: 'Netherlands', iso: 'nl', phoneCode: '+31' },
        { label: 'New Caledonia', value: 'New Caledonia', iso: 'nc', phoneCode: '+687' },
        { label: 'New Zealand', value: 'New Zealand', iso: 'nz', phoneCode: '+64' },
        { label: 'Nicaragua', value: 'Nicaragua', iso: 'ni', phoneCode: '+505' },
        { label: 'Niger', value: 'Niger', iso: 'ne', phoneCode: '+227' },
        { label: 'Nigeria', value: 'Nigeria', iso: 'ng', phoneCode: '+234' },
        { label: 'Niue', value: 'Niue', iso: 'nu', phoneCode: '+683' },
        { label: 'Norfolk Island', value: 'Norfolk Island', iso: 'nf', phoneCode: '+672' },
        { label: 'North Korea', value: 'North Korea', iso: 'kp', phoneCode: '+850' },
        { label: 'North Macedonia', value: 'North Macedonia', iso: 'mk', phoneCode: '+389' },
        { label: 'Northern Ireland', value: 'Northern Ireland', iso: 'gb-nir', phoneCode: '+44' },
        { label: 'Northern Mariana Islands', value: 'Northern Mariana Islands', iso: 'mp', phoneCode: '+1-670' },
        { label: 'Norway', value: 'Norway', iso: 'no', phoneCode: '+47' },
        { label: 'Oman', value: 'Oman', iso: 'om', phoneCode: '+968' },
        { label: 'Pakistan', value: 'Pakistan', iso: 'pk', phoneCode: '+92' },
        { label: 'Palau', value: 'Palau', iso: 'pw', phoneCode: '+680' },
        { label: 'Palestine', value: 'Palestine', iso: 'ps', phoneCode: '+970' },
        { label: 'Panama', value: 'Panama', iso: 'pa', phoneCode: '+507' },
        { label: 'Papua New Guinea', value: 'Papua New Guinea', iso: 'pg', phoneCode: '+675' },
        { label: 'Paraguay', value: 'Paraguay', iso: 'py', phoneCode: '+595' },
        { label: 'Peru', value: 'Peru', iso: 'pe', phoneCode: '+51' },
        { label: 'Philippines', value: 'Philippines', iso: 'ph', phoneCode: '+63' },
        { label: 'Poland', value: 'Poland', iso: 'pl', phoneCode: '+48' },
        { label: 'Portugal', value: 'Portugal', iso: 'pt', phoneCode: '+351' },
        { label: 'Puerto Rico', value: 'Puerto Rico', iso: 'pr', phoneCode: '+1-787' },
        { label: 'Qatar', value: 'Qatar', iso: 'qa', phoneCode: '+974' },
        { label: 'Réunion', value: 'Réunion', iso: 're', phoneCode: '+262' },
        { label: 'Romania', value: 'Romania', iso: 'ro', phoneCode: '+40' },
        { label: 'Russia', value: 'Russia', iso: 'ru', phoneCode: '+7' },
        { label: 'Rwanda', value: 'Rwanda', iso: 'rw', phoneCode: '+250' },
        { label: 'Saint Barthélemy', value: 'Saint Barthélemy', iso: 'bl', phoneCode: '+590' },
        { label: 'Saint Helena', value: 'Saint Helena', iso: 'sh', phoneCode: '+290' },
        { label: 'Saint Kitts & Nevis', value: 'Saint Kitts & Nevis', iso: 'kn', phoneCode: '+1-869' },
        { label: 'Saint Lucia', value: 'Saint Lucia', iso: 'lc', phoneCode: '+1-758' },
        { label: 'Saint Martin', value: 'Saint Martin', iso: 'mf', phoneCode: '+590' },
        { label: 'Saint Pierre & Miquelon', value: 'Saint Pierre & Miquelon', iso: 'pm', phoneCode: '+508' },
        { label: 'Saint Vincent & Grenadines', value: 'Saint Vincent & Grenadines', iso: 'vc', phoneCode: '+1-784' },
        { label: 'Samoa', value: 'Samoa', iso: 'ws', phoneCode: '+685' },
        { label: 'San Marino', value: 'San Marino', iso: 'sm', phoneCode: '+378' },
        { label: 'São Tomé & Príncipe', value: 'São Tomé & Príncipe', iso: 'st', phoneCode: '+239' },
        { label: 'Saudi Arabia', value: 'Saudi Arabia', iso: 'sa', phoneCode: '+966' },
        { label: 'Senegal', value: 'Senegal', iso: 'sn', phoneCode: '+221' },
        { label: 'Serbia', value: 'Serbia', iso: 'rs', phoneCode: '+381' },
        { label: 'Seychelles', value: 'Seychelles', iso: 'sc', phoneCode: '+248' },
        { label: 'Sierra Leone', value: 'Sierra Leone', iso: 'sl', phoneCode: '+232' },
        { label: 'Singapore', value: 'Singapore', iso: 'sg', phoneCode: '+65' },
        { label: 'Sint Maarten', value: 'Sint Maarten', iso: 'sx', phoneCode: '+1-721' },
        { label: 'Slovakia', value: 'Slovakia', iso: 'sk', phoneCode: '+421' },
        { label: 'Slovenia', value: 'Slovenia', iso: 'si', phoneCode: '+386' },
        { label: 'Solomon Islands', value: 'Solomon Islands', iso: 'sb', phoneCode: '+677' },
        { label: 'Somalia', value: 'Somalia', iso: 'so', phoneCode: '+252' },
        { label: 'South Africa', value: 'South Africa', iso: 'za', phoneCode: '+27' },
        { label: 'South Korea', value: 'South Korea', iso: 'kr', phoneCode: '+82' },
        { label: 'South Sudan', value: 'South Sudan', iso: 'ss', phoneCode: '+211' },
        { label: 'Spain', value: 'Spain', iso: 'es', phoneCode: '+34' },
        { label: 'Sri Lanka', value: 'Sri Lanka', iso: 'lk', phoneCode: '+94' },
        { label: 'Sudan', value: 'Sudan', iso: 'sd', phoneCode: '+249' },
        { label: 'Suriname', value: 'Suriname', iso: 'sr', phoneCode: '+597' },
        { label: 'Sweden', value: 'Sweden', iso: 'se', phoneCode: '+46' },
        { label: 'Switzerland', value: 'Switzerland', iso: 'ch', phoneCode: '+41' },
        { label: 'Syria', value: 'Syria', iso: 'sy', phoneCode: '+963' },
        { label: 'Taiwan', value: 'Taiwan', iso: 'tw', phoneCode: '+886' },
        { label: 'Tajikistan', value: 'Tajikistan', iso: 'tj', phoneCode: '+992' },
        { label: 'Tanzania', value: 'Tanzania', iso: 'tz', phoneCode: '+255' },
        { label: 'Thailand', value: 'Thailand', iso: 'th', phoneCode: '+66' },
        { label: 'Timor-Leste', value: 'Timor-Leste', iso: 'tl', phoneCode: '+670' },
        { label: 'Togo', value: 'Togo', iso: 'tg', phoneCode: '+228' },
        { label: 'Tonga', value: 'Tonga', iso: 'to', phoneCode: '+676' },
        { label: 'Trinidad & Tobago', value: 'Trinidad & Tobago', iso: 'tt', phoneCode: '+1-868' },
        { label: 'Tunisia', value: 'Tunisia', iso: 'tn', phoneCode: '+216' },
        { label: 'Turkey', value: 'Turkey', iso: 'tr', phoneCode: '+90' },
        { label: 'Turkmenistan', value: 'Turkmenistan', iso: 'tm', phoneCode: '+993' },
        { label: 'Turks & Caicos Islands', value: 'Turks & Caicos Islands', iso: 'tc', phoneCode: '+1-649' },
        { label: 'Tuvalu', value: 'Tuvalu', iso: 'tv', phoneCode: '+688' },
        { label: 'Uganda', value: 'Uganda', iso: 'ug', phoneCode: '+256' },
        { label: 'Ukraine', value: 'Ukraine', iso: 'ua', phoneCode: '+380' },
        { label: 'United Arab Emirates', value: 'United Arab Emirates', iso: 'ae', phoneCode: '+971' },
        { label: 'United Kingdom', value: 'United Kingdom', iso: 'gb', phoneCode: '+44' },
        { label: 'United States', value: 'United States', iso: 'us', phoneCode: '+1' },
        { label: 'Uruguay', value: 'Uruguay', iso: 'uy', phoneCode: '+598' },
        { label: 'Uzbekistan', value: 'Uzbekistan', iso: 'uz', phoneCode: '+998' },
        { label: 'Vanuatu', value: 'Vanuatu', iso: 'vu', phoneCode: '+678' },
        { label: 'Vatican City', value: 'Vatican City', iso: 'va', phoneCode: '+379' },
        { label: 'Venezuela', value: 'Venezuela', iso: 've', phoneCode: '+58' },
        { label: 'Vietnam', value: 'Vietnam', iso: 'vn', phoneCode: '+84' },
        { label: 'Wallis & Futuna', value: 'Wallis & Futuna', iso: 'wf', phoneCode: '+681' },
        { label: 'Yemen', value: 'Yemen', iso: 'ye', phoneCode: '+967' },
        { label: 'Zambia', value: 'Zambia', iso: 'zm', phoneCode: '+260' },
        { label: 'Zimbabwe', value: 'Zimbabwe', iso: 'zw', phoneCode: '+263' }
    ],
    options: [],
    isOpen: false,
    openedWithKeyboard: false,
    selectedOption: null,
    setSelectedOption(option) {
        this.selectedOption = option
        this.isOpen = false
        this.openedWithKeyboard = false
        this.$refs.phoneNumber.value = option.phoneCode + ' '
    },
    getFilteredOptions(query) {
        this.options = this.allOptions.filter(
            (option) =>
            option.label.toLowerCase().includes(query.toLowerCase()) ||
            option.phoneCode.includes(query.toLowerCase()),
        )
        if (this.options.length === 0) {
            this.$refs.noResultsMessage.classList.remove('hidden')
        } else {
            this.$refs.noResultsMessage.classList.add('hidden')
        }
    },
    handleKeydownOnOptions(event) {
        // if the user presses backspace or the alpha-numeric keys, focus on the search field
        if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 8) {
            this.$refs.searchField.focus()
        }
    },
}" class="flex w-full max-w-xs flex-col gap-1">
    <div class="relative flex w-full" x-on:keydown="handleKeydownOnOptions($event)"
        x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false" x-init="(options = allOptions), setSelectedOption(options[222])">

        <!-- Country Selector  -->
        <div>
            <!-- Trigger Button  -->
            <button type="button"
                class="inline-flex w-max items-center justify-between gap-2 whitespace-nowrap rounded-l-xl border border-slate-300 border-r-0 bg-slate-100 px-4 py-2 text-sm font-medium tracking-wide text-slate-700 transition hover:opacity-75 focus-visible:outline-none focus-visible:slate-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-300 dark:focus-visible:outline-blue-600"
                role="combobox" aria-controls="countriesList" aria-haspopup="listbox" x-on:click="isOpen = ! isOpen"
                x-on:keydown.down.prevent="openedWithKeyboard = true"
                x-on:keydown.enter.prevent="openedWithKeyboard = true"
                x-on:keydown.space.prevent="openedWithKeyboard = true"
                x-bind:aria-expanded="isOpen || openedWithKeyboard"
                x-bind:aria-label="selectedOption ? selectedOption.value : 'Please Select'">
                <!-- Selected Country Flag  -->
                <img class="h-3.5 w-5" x-bind:alt="selectedOption.value"
                    x-bind:src="'https://flagcdn.com/' + selectedOption.iso + '.svg'" />
                <!-- Chevron  -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0"
                    aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd">
                </svg>
            </button>
            <!-- Dropdown  -->
            <div x-show="isOpen || openedWithKeyboard" id="countriesList"
                class="absolute left-0 top-11 z-10 w-full overflow-hidden rounded-xl border border-slate-300 bg-slate-100 dark:border-slate-700 dark:bg-slate-800"
                role="listbox" aria-label="countries list"
                x-on:click.outside="isOpen = false, openedWithKeyboard = false"
                x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()"
                x-transition x-trap="openedWithKeyboard">
                <!-- Search  -->
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                        stroke-width="1.5"
                        class="absolute left-4 top-1/2 size-5 -translate-y-1/2 text-slate-700/50 dark:text-slate-300/50"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input type="text"
                        class="w-full border-b borderslate-300 bg-slate-100 py-2.5 pl-11 pr-4 text-sm text-slate-700 focus:outline-none focus-visible:border-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:focus-visible:border-blue-600"
                        name="searchField" aria-label="Search" x-on:input="getFilteredOptions($el.value)"
                        x-ref="searchField" placeholder="Search" />
                </div>
                <!-- Options  -->
                <ul class="flex max-h-44 flex-col overflow-y-auto">
                    <li class="hidden px-4 py-2 text-sm text-slate-700 dark:text-slate-300" x-ref="noResultsMessage">
                        <span>No matches found</span>
                    </li>
                    <template x-for="(item, index) in options" x-bind:key="item.value">
                        <li class="inline-flex cursor-pointer justify-between gap-6 bg-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-800/5 hover:text-black focus-visible:bg-slate-800/5 focus-visible:text-black focus-visible:outline-none dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-100/5 dark:hover:text-white dark:focus-visible:bg-slate-100/10 dark:focus-visible:text-white"
                            role="option" x-on:click="setSelectedOption(item)"
                            x-on:keydown.enter="setSelectedOption(item)" x-bind:id="'option-' + index" tabindex="0">
                            <div class="flex items-center gap-2">
                                <!-- Flag Image  -->
                                <img class="h-3.5 w-5" alt="" aria-hidden="true"
                                    x-bind:src="'https://flagcdn.com/' + item.iso + '.svg'" />
                                <!-- Label  -->
                                <span x-bind:class="selectedOption == item ? 'font-bold' : null"
                                    x-text="item.value"></span>
                                <span class="font-bold" x-text="'(' + item.phoneCode + ')'"></span>
                                <!-- Screen reader 'selected' indicator  -->
                                <span class="sr-only" x-text="selectedOption == item ? 'selected' : null"></span>
                            </div>
                            <!-- Checkmark  -->
                            <svg x-show="selectedOption == item" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                stroke="currentColor" fill="none" stroke-width="2" class="size-4" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
        <input {!! $attributes->merge(
            array_merge($atts, [
                'id' => $id,
                'x-ref' => 'phoneNumber',
                'value' => $value,
                'placeholder' => $placeholder,
                'autofocus' => $autofocus ? '' : null,
                'autocomplete' => $autocomplete,
                'required' => $required ? '' : null,
                'disabled' => $disabled ? '' : null,
                'aria-describedby' => $info ? $id . '-help' : null,
                'class' => Arr::toCssClasses(['form-control', 'error' => $error]),
            ]),
        ) !!}>
        {{-- <input id="phoneNumber" type="tel"
            class="w-full border-slate-300 rounded-r-xl border rounded-l-none bg-slate-100 px-2.5 py-2 text-sm text-slate-700 focus:outline-none focus-visible:slate-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:text-slate-300 dark:focus-visible:outline-blue-600"
            x-ref="phoneNumber" autocomplete="phone" placeholder="+00 000-000-0000" /> --}}
    </div>
</div>
