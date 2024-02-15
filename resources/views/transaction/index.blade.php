<x-app-layout>
    <x-slot name="header">
        Pesanan
    </x-slot>

    <div>
        @foreach($transactions as $transaction)
            <div class="rounded-[12px] mt-5 bg-white flex h-[115px] flex p-3">
                <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_434_140)">
                        <path d="M1.4787 18.2585C0.6201 18.1048 0 17.3628 0 16.4936V14.5273C0 13.6581 0.6201 12.9161 1.4787 12.7624L3.8001 12.3596C4.0757 11.3473 4.4838 10.3721 5.0085 9.4658L3.6464 7.526C3.1482 6.8158 3.233 5.8512 3.8478 5.2364L5.2417 3.8372C5.8512 3.2277 6.8158 3.1429 7.526 3.6411L9.4658 5.0085C10.3721 4.4838 11.3473 4.081 12.3596 3.8054L12.7624 1.484C12.9108 0.6254 13.6581 0 14.5273 0H16.4989C17.3681 0 18.1048 0.6254 18.2585 1.4787L18.6613 3.8001C19.6789 4.0757 20.6541 4.4838 21.5604 5.0085L23.4949 3.6517C24.2051 3.1535 25.1697 3.2383 25.7792 3.8531L27.1837 5.2417C27.7932 5.8565 27.878 6.8211 27.3798 7.5313L26.023 9.4658C26.4205 10.1654 26.7438 10.9074 26.9929 11.6706C26.4152 12.3861 26.0283 13.2341 25.8693 14.1351L25.6785 15.2163L25.1008 15.4548L24.2051 14.8347C23.2882 14.1881 22.1911 13.8436 21.0622 13.8436C20.8873 13.8436 20.7177 13.8754 20.5216 13.8913C19.769 11.4957 17.4317 9.9534 14.9301 10.2078C12.4232 10.4622 10.4463 12.4391 10.1866 14.946C9.9269 17.4476 11.4639 19.7849 13.8595 20.5481C13.7323 21.8413 14.0768 23.1451 14.8241 24.2104L15.4495 25.1061C15.37 25.2916 15.2905 25.4877 15.211 25.6838L14.1298 25.8746C13.2288 26.0336 12.3808 26.4205 11.6653 26.9982C10.9021 26.7491 10.1601 26.4258 9.4605 26.0283L7.5207 27.3851C6.8105 27.878 5.8512 27.7932 5.2417 27.1837L3.8478 25.7845C3.233 25.1697 3.1482 24.2051 3.6464 23.4949L5.0085 21.5604C4.4838 20.6541 4.081 19.6842 3.8054 18.6666L1.4787 18.2585Z" fill="#0058DE"/>
                        <path opacity="0.4" d="M33.7769 12.8154C34.874 12.826 35.8068 13.6104 35.9976 14.6863L36.5382 17.6384C37.8049 17.9882 39.0239 18.5023 40.1634 19.1648L42.6385 17.4476C43.5395 16.8116 44.7691 16.9229 45.5482 17.702L47.3184 19.4669C48.0975 20.2513 48.2035 21.4756 47.5728 22.3766L45.8503 24.8358C46.5181 25.9859 47.0322 27.2261 47.3767 28.514L50.3235 29.0546C51.3941 29.2401 52.1838 30.1676 52.1997 31.2541V33.7398C52.1997 34.8422 51.4047 35.7856 50.3235 35.9764L47.3767 36.517C47.0269 37.7943 46.5128 39.0186 45.8503 40.1634L47.5728 42.6173C48.23 43.5289 48.1187 44.785 47.3184 45.5694L45.5694 47.3184C44.7903 48.0975 43.5607 48.2035 42.6597 47.5728L40.1634 45.8503C39.008 46.5181 37.7731 47.0269 36.4852 47.3767L35.9446 50.3235C35.7538 51.4047 34.8104 52.1997 33.708 52.1997H31.2541C30.1517 52.1997 29.2136 51.4047 29.0228 50.3235L28.4769 47.3767C27.1943 47.0269 25.9594 46.5181 24.8093 45.8503L22.3713 47.5728C21.4703 48.2035 20.246 48.0975 19.4616 47.3184L17.6967 45.5694C16.907 44.785 16.801 43.5448 17.4476 42.6385L19.1648 40.1634C18.5023 39.008 17.9882 37.7731 17.6437 36.4905L14.6916 35.9499C13.6104 35.7591 12.8207 34.8157 12.8154 33.7133V31.2541C12.8207 30.157 13.6051 29.2136 14.6863 29.0228L17.6384 28.4769C17.9829 27.1943 18.497 25.9541 19.1595 24.804L17.4476 22.3713C16.8116 21.4703 16.9229 20.246 17.702 19.4616L19.4669 17.6967C20.2513 16.9229 21.4703 16.8169 22.3713 17.4476L24.8305 19.1648C25.9806 18.5023 27.2155 17.9882 28.5034 17.6437L29.044 14.6916C29.2348 13.6104 30.1729 12.8207 31.2753 12.8154H33.7769ZM32.5102 25.7527C28.779 25.7527 25.7527 28.779 25.7527 32.5102C25.7527 36.2414 28.779 39.2624 32.5102 39.2624C36.2414 39.2624 39.2624 36.2414 39.2624 32.5102C39.2624 28.779 36.2414 25.7527 32.5102 25.7527Z" fill="#0058DE"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_434_140">
                            <rect width="53" height="53" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>

                <div class="ml-3">
                    <h3 class="font-bold color-blue-primary">{{ $transaction->customer_username }}</h3>
                    <p class="text-sm">{{ $transaction->customer_phone_number ?? '089533665544' }}</p>
                    <p class="text-sm">{{ $transaction->created_at }}</p>
                </div>
                <div class="ml-auto">
                    @if($transaction->status === \App\Http\Enum\TransactionStatus::WAITING_CONFIRMATION->name)
                        <div class="text-[11px] text-center w-[70px] bg-blue-primary text-white rounded-[4px]">Pending
                        </div>
                    @else
                        <div
                            class="text-[11px] text-center w-[70px] bg-blue-primary text-white rounded-[4px]">{{$transaction->status ?? 'empty'}}</div>
                    @endif

                    <a href="#" class="font-bold text-[12px] color-blue-primary mt-12 block">Lihat Detail</a>
                </div>
            </div>
        @endforeach
    </div>

</x-app-layout>
