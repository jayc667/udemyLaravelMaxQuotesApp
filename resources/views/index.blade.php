<!--  inherit the master.blade.php in layouts folder -->
@extends('layouts.master')

<!--  content inside this section is displayed in master.blade.php -->
@section('title')
	Quotes App using Laravel
@endsection



@section('styles')

	<!--  we use fontawesome for pagination arrows. -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
@endsection

@section('content')

	<!--  display the quotes -->
	
	
	<section class="quotes">
		<h1> Latest Quotes</h1>
		
		@for($i = 0; $i < count($quotes); $i++)
		
			<!--  style & design for each of the quotes -->
			<!--  here we are going to programmatically select the css class to be applied to the quotes. -->
			<!-- We will have 3 post per row. for leftmost post we will apply first-in-line class & for rightmost post we will apply last-in-line class
			i = 0 initially, we check modulus of 3, the value is 0, so we will apply first-in-line class
			i=1, modulus of 3 is not 0, so we will then check if $i+1's modulus of 3 is 0, it is not, so we will apply ''
			i=2, modulus of 3 is not 0, so we will then check if $i+1's modulus of 3 is 0, which is true, so it must be rightmost element, so we will apply last-in-line class  -->
			<article class="quote{{ $i % 3 === 0 ? ' first-in-line' : (($i+1) %3 === 0 ? '  last-in-line' : '' )}}">
				
				<div class="delete"><a href="#">x</a></div>
				
							{{ $quotes[$i]->quote }}	
							
				<div class="info">Created by  <a href="#">{{ $quotes[$i]->author->name }}</a> on {{ $quotes[$i]->created_at }} </div>
				
			</article>
		 
		  
		@endfor
	
		
		
		<div class="pagination">
			Pagination
		</div>
			
	</section>
	
	<!--  add a quote -->
	<section class="edit-quote">
		<h1> Add a Quote</h1>
		
		<!-- form to add a quote -->
		<form method="post" action={{ route('create')}}>
			<div class="input-group">
				<label for="author">Your Name </label>
				<input type="text" name="author" id="author" placeholder="Your Name" />
			</div>
			<div class="input-group">
				<label for="quote">Your Quote </label>
				<textarea name="quote" id="quote" rows="5" placeholder="Quote"></textarea>
			</div>
			<button type="submit" class="btn"> Submit Quote</button>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
		
		</form>
	</section>
	
@endsection

