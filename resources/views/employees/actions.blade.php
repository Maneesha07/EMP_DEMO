<a class="btn btn-sm btn-primary" style="float: left" title="Edit"  href="{{ route('employee.edit', $employee) }}"><i class="fa fa-pen"></i></a>
<form action="{{ route('employee.destroy', $employee) }}" method="post">
    @csrf
    @method('delete')
    <button type="button" title="Delete" class="btn btn-sm btn-danger" onclick="confirm('{{ __("Are you sure you want to delete this employee?") }}') ? this.parentElement.submit() : ''">
        <i class="fa fa-trash"></i>
    </button>
</form>
