<body>
<h1 style="text-align: center">{{ __('USERS LIST') }}</h1>
<table style="border: 1px solid black; width: 100%">
    <thead style="text-align: center; font-weight: bold">
            <tr>
                <td style="border: 1px solid black;">{{__('Name')}}</td>
                <td style="border: 1px solid black;">{{__('Username')}}</td>
                <td style="border: 1px solid black;">{{__('Email')}}</td>
                <td style="border: 1px solid black;">{{__('Address')}}</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td style="border: 1px solid black;">{{$user->name}}</td>
                    <td style="border: 1px solid black;">{{$user->username}}</td>
                    <td style="border: 1px solid black;">{{$user->email}}</td>
                    <td style="border: 1px solid black;">{{$user->address}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
