<body>
    <h1 style="text-align: center">{{ __('PRODUCT LIST') }}</h1>
    <table style="border: 1px solid black; width: 100%">
        <thead style="text-align: center; font-weight: bold">
            <tr>
                <td style="border: 1px solid black;">{{__('Name')}}</td>
                <td style="border: 1px solid black;">{{__('Description')}}</td>
                <td style="border: 1px solid black;">{{__('Stock')}}</td>
                <td style="border: 1px solid black;">{{__('Price')}}/u</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td style="border: 1px solid black;">{{$product->name}}</td>
                    <td style="border: 1px solid black;">{{$product->description}}</td>
                    <td style="border: 1px solid black;">{{$product->stock}}</td>
                    <td style="border: 1px solid black;">{{$product->price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
