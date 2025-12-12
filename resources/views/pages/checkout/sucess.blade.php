@extends('layouts.app')

@section('title', 'Compra Finalizada com Sucesso!')

@section('content')
    <div class="container" style="padding: 60px 0; text-align: center;">
        
        @if (session('success'))
            <h1 style="color: #28a745;">✅ Compra Finalizada com Sucesso!</h1>
            <p style="font-size: 1.2em; margin-bottom: 30px;">
                Obrigado pela sua compra, **{{ Auth::user()->name }}**!
            </p>
            <div style="border: 1px solid #c3e6cb; background-color: #d4edda; padding: 20px; border-radius: 8px; display: inline-block;">
                <p>Seu pedido foi processado e será enviado em breve. Um e-mail de confirmação foi enviado para você.</p>
            </div>
        @else
            <h1 style="color: #ffc107;">Erro</h1>
            <p>Não há dados de sucesso. Você pode ter acessado a página diretamente.</p>
        @endif
        
        <div style="margin-top: 40px;">
            <a href="{{ url('/') }}" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
                Voltar para a Loja
            </a>
        </div>
    </div>
@endsection