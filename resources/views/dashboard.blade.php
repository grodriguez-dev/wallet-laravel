<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to your wallet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center">
                        @if (empty($wallet))
                            <h1 style="font-size: 50px;">Saldo Actual: 0</h1>
                        @else
                            <h1 style="font-size: 50px;">Saldo Actual: {{$wallet->amount}}$</h1>
                        @endif
                    </div>
                    <form action="{{route('wallets.operation')}}" method="POST">
                        @csrf
                        <div class="flex">
                            <input id="amount" type="text" name="amount" placeholder="Ingresar monto" value="" class="w-full px-4 py-3 rounded" onKeyPress="return soloNumeros(event)" required="">
                            <select class="px-4 py-3 rounded" name="operation" required="">
                                <option value="">Selecciona una operacion...</option>
                                <option value="1">Suma</option>
                                @if (!empty($wallet))
                                    <option value="0">Resta</option>
                                @endif
                            </select>
                            <button type="submit" class="ml-4 w-auto px-6 py-3 font-semibold bg-gray-900 text-white rounded" onclick="getValueInput()">
                                <span>Ejecutar</span>
                            </button>
                        </div>
                    </form>
                    
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    @if (session('message') == 'Restados')
                        <div class="flex py-5" style="font-size: 50px;color: red;">
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message').' '.$wallet->register.'$ correctamente' }}
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="flex py-5" style="font-size: 50px;color: green;">
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message').' '.$wallet->register.'$ correctamente' }}
                                </div>
                            @endif
                        </div>
                    @endif
                
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function soloNumeros(e)
        {
            var key = window.Event ? e.which : e.keyCode
            return ((key >= 48 && key <= 57) || (key==8))
        }
    </script>
</x-app-layout>
