<table class="mage2-table-grid table table-striped table-responsive ">
    <tr class="table-dark">
        @foreach($dataGrid->columns as $column)
            <th>
                @if($column->sortable() && $dataGrid->desc($column->identifier()))
                    <a href="{{ $column->ascUrl() }}">
                        {{ $column->label() }}
                        <i class="text-primary oi oi-arrow-bottom"></i>
                    </a>
                @elseif($column->sortable() && $dataGrid->asc($column->identifier()))
                        <a href="{{ $column->descUrl() }}">
                            {{ $column->label() }}
                            <i class="text-primary oi oi-arrow-top"></i>
                        </a>
                @elseif($column->sortable() )
                    <a href="{{ $column->descUrl() }}">
                        {{ $column->label() }}
                        <i class="text-secondary oi oi-arrow-top"></i>
                    </a>
                @else
                    {{ $column->label() }}
                @endif
            </th>
        @endforeach
    </tr>

    @foreach($dataGrid->data as $row)
        <tr>
            @foreach($dataGrid->columns as $column)
                <td>
                    @if($column->type() == "link")
                        {!! $column->executeCallback($row) !!}
                    @elseif($column->type() == "online")
                        <?php $identifier = $column->identifier() ?>
                        <div class="status {{ $row->$identifier ? 'online' : 'offline' }}"></div>
                    @elseif($column->type() == "image")
                        <?php $identifier = $column->identifier() ?>
                        <img height="30px" width="30px" src="{{ $row->$identifier->smallUrl }}" />
                    @elseif($column->identifier() == "created_at")
                        <?php $identifier = $column->identifier() ?>
                        {{ $row->$identifier->format('j. m. Y. H:i') }}
                    @else
                        <?php $identifier = $column->identifier() ?>
                        {{ $row->$identifier }}
                    @endif
                </td>
            @endforeach
        </tr>
    @endforeach
</table>

{!! $dataGrid->data->appends(Request::except('page'))->render('pagination::bootstrap-4') !!}