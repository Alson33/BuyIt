@extends('layouts.templates.show')

@section('sub-content')
    <div class="bg-white p-4 row">
        <div class="col-6">
            <img src="{{ $item->getFirstMediaUrl('item_images')?$item->getFirstMediaUrl('item_images'):asset('images/item_placeholder_image.jpg') }}" alt="item image" style="width: 500px; height: 500px; object-fit:cover;">
        </div>
        <div class="col-6 py-4">
            <h3>{{ $item->name }}</h3>
            @if ($item->in_stock)
            <p>In stock: {{ $item->available_amount }}</p>    
            @else
                <p class="text-danger">Out of stock</p>
            @endif
            <p>Rs: {{ $item->price_per }} per piece</p>
            @if (!auth()->user()->hasAnyRole(['superadmin', 'admin']))
                <div class="my-4">
                    <form action="{{ route('order.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <div class="form-group row">
                            <div class="col-4">
                                <span class="bg-light p-2 mx-2" id="minus"><i class="fas fa-minus"></i></span>
                                <span id="quantity-placeholder">0</span>
                                <input type="hidden" name="quantity" required id="quantity-field">
                                <span class="bg-light p-2 mx-2" id="plus"><i class="fas fa-plus"></i></span>
                            </div>
                            <div class="col-7">
                                <input type="submit" value="order" class="btn btn-outline-info">
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        let stock = {{ $item->available_amount }};
        let plus = document.getElementById('plus');
        let minus = document.getElementById('minus');
        let qPlaceholder = document.getElementById('quantity-placeholder');
        let qField = document.getElementById('quantity-field');
        var count = 0;

        plus.addEventListener('click', increase);
        minus.addEventListener('click', decrease);

        function increase()
        {
            if(count < stock){
                count++
                qPlaceholder.innerHTML = count;
                qField.value = count;
            }
        }

        function decrease()
        {
            if(count > 0){
                count--
                qPlaceholder.innerHTML = count;
                if(count == 0)
                   qField.value = null;
                else
                    qField.value = count;
            }
        }

    </script>
@endsection