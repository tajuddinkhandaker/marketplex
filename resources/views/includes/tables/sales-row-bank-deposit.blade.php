<tr id="row{{ $row_id }}" class="dynamic-added bank_deposit" data-row-id="{{ $row_id }}">
	<td>
		<p>
		{{ $datetime }} <input name="deposits[{{ $row_id }}][bank_deposit_id]" type="hidden" value="{{ isset($bank_deposit_id) ? $bank_deposit_id : -1 }}" />
		</p>
	</td>
	<td>
		@isset($invoice)
		<p>{{ !isset($deposit_method) || $deposit_method == 'bank' ? 'Bank' : 'Vault' }}</p>
		@else
		<div class="form-group">			
		<select class="form-control deposit_method" 
				id="deposits.{{ $row_id }}.deposit_method" name="deposits[{{ $row_id }}][deposit_method]"
				row-id="{{ $row_id }}"
				data-toggle="tooltip" data-placement="top"
				title="{{ isset($deposit_method) ? $deposit_method . ' is selected' : 'Choose one' }}">
			<option value="bank"{{ !isset($deposit_method) || $deposit_method == 'bank' ? ' selected' : '' }}>Bank</option>
			<option value="vault"{{ isset($deposit_method) && $deposit_method == 'vault' ? ' selected' : '' }}>Vault</option>
		</select>
		</div>
		@endisset
	</td>
	<td>
		<div class="form-group{{ isset($deposit_method) && $deposit_method == 'vault' ? ' hidden' : '' }}">
		<p id="deposits.{{ $row_id }}.bank_title">			
			@isset($bank_account_no)
				@foreach( (is_string($bank_accounts) ? json_decode($bank_accounts) : $bank_accounts) as $acc)
					@if($bank_account_no == $acc->account_no)
						{!! $acc->htmlSummary() !!}
						<input 	type="hidden"
								name="deposits[{{ $row_id }}][bank_title]" value="{{ $acc->bank_title }}" />
						<input 	type="hidden"
								name="deposits[{{ $row_id }}][bank_branch]" value="{{ $acc->bank_branch }}" />
					@endif
				@endforeach
			@else
				<i> {{ isset($invoice) && $invoice ? '---' : 'Select an account' }} </i>
			@endisset
		</p>
		</div>
	</td>
	<td>
		@isset($invoice)
		<p>{{ $bank_account_no or '---' }}</p>
		@else
			<div class="form-group{{ isset($deposit_method) && $deposit_method == 'vault' ? ' hidden' : '' }}">		
			<select class="form-control deposit_account"
					id="deposits.{{ $row_id }}.bank_ac_no" name="deposits[{{ $row_id }}][bank_ac_no]"
					row-id="{{ $row_id }}"
					data-toggle="tooltip" data-placement="top"
					title="{{ isset($bank_account_no) ? $bank_account_no . ' is selected' : 'Choose one' }}">
			<option value="" {{ isset($bank_account_no) ? '' : 'selected'}}>-- Select --</option>		

			@foreach( (is_string($bank_accounts) ? json_decode($bank_accounts) : $bank_accounts) as $acc)
				<option value="{{ $acc->id }}"
				data-toggle="tooltip" data-placement="top"
				title='{{ "Bank: " . $acc->title . "\nBranch: " . $acc->branch }}'
				{{ isset($bank_account_no) && $bank_account_no == $acc->account_no ? ' selected' : '' }}>
				{{ $acc->account_no }}
				</option>
			@endforeach
			
			</select>
			{{-- Debug purpose --}}
			{{-- !is_array($bank_accounts) ? $bank_accounts : collect($bank_accounts) --}}
			</div>
		@endisset
	</td>
	<td>
		@isset($invoice)
		<i>{{ number_format( isset($deposit_amount) ? $deposit_amount : 0.00, 2) }}</i>
		@else
		<div class="form-group">			
		<input 	id="deposits.{{ $row_id }}.deposit_amount" name="deposits[{{ $row_id }}][deposit_amount]" class="decimal form-control" row-id="{{ $row_id }}"
				type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.which === 8"
				value="{{ number_format(isset($deposit_amount) ? $deposit_amount : 0.00, 2) }}" required />
		</div>
		@endisset
	</td>
	@if( ! isset($invoice) )
	<td><a href="" name="remove" id="{{ $row_id }}" class="btn_remove fa fa-close fa-2x" data-toggle="tooltip" data-placement="top" title="Remove this entry"></a></td>
	@endif
</tr>