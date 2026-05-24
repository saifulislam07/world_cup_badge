@extends('admin.layout')
@section('title', 'Visitor Logs')
@section('content')
    <section class="panel">
        <h2>Filters</h2>
        <form class="filters compact" method="get">
            <div>
                <label for="date">Date</label>
                <input id="date" name="date" type="date" value="{{ request('date', $date) }}">
            </div>
            <div>
                <label for="path">Path</label>
                <input id="path" name="path" value="{{ request('path') }}" placeholder="/today-match">
            </div>
            <div>
                <label for="ip">IP Address</label>
                <input id="ip" name="ip" value="{{ request('ip') }}" placeholder="127.0.0.1">
            </div>
            <button type="submit">Filter</button>
        </form>
    </section>

    <section class="split">
        <div class="panel">
            <h2>Day-wise Visitors</h2>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Date</th><th>Total Visits</th><th>Unique IP</th></tr></thead>
                    <tbody>
                        @forelse ($dailyStats as $day)
                            <tr>
                                <td><a href="{{ route('admin.visitor-logs', ['date' => $day->visit_date]) }}">{{ $day->visit_date }}</a></td>
                                <td><span class="pill">{{ $day->total_visits }}</span></td>
                                <td>{{ $day->unique_visitors }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3">No visits recorded yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel">
            <h2>Top Pages on {{ $date }}</h2>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Path</th><th>Visits</th></tr></thead>
                    <tbody>
                        @forelse ($pathStats as $row)
                            <tr><td>{{ $row->path }}</td><td><span class="pill">{{ $row->total }}</span></td></tr>
                        @empty
                            <tr><td colspan="2">No page visits for this date.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="panel">
        <h2>Visitor Details</h2>
        <p class="muted">Showing detailed visits for {{ $date }}. Use filters above to narrow by page or IP.</p>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>IP</th>
                        <th>Path</th>
                        <th>Route</th>
                        <th>Referer</th>
                        <th>User Agent</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->visited_at?->format('H:i:s') }}</td>
                            <td>{{ $log->ip_address }}</td>
                            <td>{{ $log->path }}</td>
                            <td>{{ $log->route_name }}</td>
                            <td>{{ $log->referer ?: '-' }}</td>
                            <td>{{ $log->user_agent ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No detailed visits found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pager">
            <div class="muted">Showing {{ $logs->firstItem() ?? 0 }} to {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }} visits</div>
            <div class="pager-actions">
                @if ($logs->onFirstPage())
                    <span class="pager-button disabled">Previous</span>
                @else
                    <a class="pager-button" href="{{ $logs->previousPageUrl() }}">Previous</a>
                @endif

                @foreach ($logs->getUrlRange(max(1, $logs->currentPage() - 2), min($logs->lastPage(), $logs->currentPage() + 2)) as $page => $url)
                    @if ($page === $logs->currentPage())
                        <span class="pager-button active">{{ $page }}</span>
                    @else
                        <a class="pager-button" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($logs->hasMorePages())
                    <a class="pager-button" href="{{ $logs->nextPageUrl() }}">Next</a>
                @else
                    <span class="pager-button disabled">Next</span>
                @endif
            </div>
        </div>
    </section>
@endsection
