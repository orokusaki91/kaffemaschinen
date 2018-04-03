<?php

namespace App\Http\Controllers\Admin;

use App\Models\Database\Configuration;
use App\Models\Database\Order;
use App\Models\Database\Visitor;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StatisticsController extends AdminController
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request)
    {
        $labelWeekCollection = Collection::make([]);
        $labelMonthCollection = Collection::make([]);
        $labelYearCollection = Collection::make([]);
        $sumOrders = Order::sum('total_amount');
        $sumCartValues = Order::all()->average('total_amount');
        $totalOrder = Order::all()->count();
        $countVisits = Visitor::all()->count();
        $visitorValueWeekCollection = Collection::make([]);
        $orderValueWeekCollection = Collection::make([]);
        $sumOrderValuesWeekCollection = Collection::make([]);
        $averageCartValueWeekCollection = Collection::make([]);
        $visitorValueMonthCollection = Collection::make([]);
        $orderValueMonthCollection = Collection::make([]);
        $sumOrderValuesMonthCollection = Collection::make([]);
        $averageCartValueMonthCollection = Collection::make([]);
        $visitorValueYearCollection = Collection::make([]);
        $orderValueYearCollection = Collection::make([]);
        $sumOrderValuesYearCollection = Collection::make([]);
        $averageCartValueYearCollection = Collection::make([]);
        $labelBetweenCollection = Collection::make([]);
        $visitorValueBetweenCollection = Collection::make([]);
        $orderValueBetweenCollection = Collection::make([]);
        $sumOrderValuesBetweenCollection = Collection::make([]);
        $averageCartValueBetweenCollection = Collection::make([]);
        $todaysDateCarbon = Carbon::today();
        $todaysDateCarbon->subDay(6);
        for ($i = 0; $i <= 6; $i++) {
            $visitorCountForThatDay = Visitor::whereDay('created_at', '=', $todaysDateCarbon->day)->get()->count();
            $orderCountForThatDay = Order::whereDay('created_at', '=', $todaysDateCarbon->day)->get()->count();
            $sumOrderValue = Order::whereDay('created_at', '=', $todaysDateCarbon->day)->get()->sum('total_amount');
            $averageCartValueForThatDay = Order::whereDay('created_at', '=', $todaysDateCarbon->day)->get()->average('total_amount');
            $labelWeekCollection->push('"' . $todaysDateCarbon->format('d-M-y').'"');
            $visitorValueWeekCollection->push($visitorCountForThatDay);
            $orderValueWeekCollection->push($orderCountForThatDay);
            $sumOrderValuesWeekCollection->push($sumOrderValue);
            if ($averageCartValueForThatDay == null)
                $averageCartValueWeekCollection->push(0);
            else
                $averageCartValueWeekCollection->push($averageCartValueForThatDay);
            $todaysDateCarbon->addDay(1);
        }
        $todaysDateCarbon = Carbon::today();
        $todaysDateCarbon->subDay(30);
        for ($i = 0; $i <= 30; $i++) {
            $visitorCountForThatDay = Visitor::whereDay('created_at', '=', $todaysDateCarbon->day)->get()->count();
            $orderCountForThatDay = Order::whereDay('created_at', '=', $todaysDateCarbon->day)->get()->count();
            $sumOrderValue = Order::whereDay('created_at', '=', $todaysDateCarbon->day)->get()->sum('total_amount');
            $averageCartValueForThatDay = Order::whereDay('created_at', '=', $todaysDateCarbon->day)->get()->average('total_amount');
            $labelMonthCollection->push('"' . $todaysDateCarbon->format('d-M-y').'"');
            $visitorValueMonthCollection->push($visitorCountForThatDay);
            $orderValueMonthCollection->push($orderCountForThatDay);
            $sumOrderValuesMonthCollection->push($sumOrderValue);
            if ($averageCartValueForThatDay == null)
                $averageCartValueMonthCollection->push(0);
            else
                $averageCartValueMonthCollection->push($averageCartValueForThatDay);
            $todaysDateCarbon->addDay(1);
        }
        $todaysDateCarbon = Carbon::today();
        $todaysDateCarbon->subYear(1);
        for ($i = 0; $i <= 365; $i++) {
            $visitorCountForThatDay = Visitor::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->count();
            $orderCountForThatDay = Order::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->count();
            $sumOrderValue = Order::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->sum('total_amount');
            $averageCartValueForThatDay = Order::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->average('total_amount');
            $labelYearCollection->push('"' . $todaysDateCarbon->format('d-M-y').'"');
            $visitorValueYearCollection->push($visitorCountForThatDay);
            $orderValueYearCollection->push($orderCountForThatDay);
            $sumOrderValuesYearCollection->push($sumOrderValue);
            if ($averageCartValueForThatDay == null)
                $averageCartValueYearCollection->push(0);
            else
                $averageCartValueYearCollection->push($averageCartValueForThatDay);
            $todaysDateCarbon->addDay(1);
        }
        if ($request['start'] != null && $request['end'] != null) {
            $start = strtotime($request['start']);
            $end = strtotime($request['end']);
            $datediff = $end - $start;
            $days = $datediff / (60 * 60 * 24);
            $todaysDateCarbon = Carbon::createFromTimestamp($start);
            for ($i = 0; $i <= $days; $i++) {
                $visitorCountForThatDay = Visitor::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->count();
                $orderCountForThatDay = Order::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->count();
                $sumOrderValue = Order::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->sum('total_amount');
                $averageCartValueForThatDay = Order::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->average('total_amount');
                $labelBetweenCollection->push('"' . $todaysDateCarbon->format('d-M-y').'"');
                $visitorValueBetweenCollection->push($visitorCountForThatDay);
                $orderValueBetweenCollection->push($orderCountForThatDay);
                $sumOrderValuesBetweenCollection->push($sumOrderValue);
                if ($averageCartValueForThatDay == null)
                    $averageCartValueBetweenCollection->push(0);
                else
                    $averageCartValueBetweenCollection->push($averageCartValueForThatDay);
                $todaysDateCarbon->addDay(1);
            }
        } else {
            $start = strtotime("2018/01/01");
            $end = strtotime(date("Y/m/d"));
            $datediff = $end - $start;
            $days = $datediff / (60 * 60 * 24);
            $todaysDateCarbon = Carbon::create(2018,01,01);
            for ($i = 0; $i <= $days; $i++) {
                $visitorCountForThatDay = Visitor::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->count();
                $orderCountForThatDay = Order::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->count();
                $sumOrderValue = Order::whereDate('created_at', '=', $todaysDateCarbon->format('Y-m-d'))->get()->sum('total_amount');
                $labelBetweenCollection->push('"' . $todaysDateCarbon->format('d-M-y').'"');
                $visitorValueBetweenCollection->push($visitorCountForThatDay);
                $orderValueBetweenCollection->push($orderCountForThatDay);
                $sumOrderValuesBetweenCollection->push($sumOrderValue);
                if ($averageCartValueForThatDay == null)
                    $averageCartValueBetweenCollection->push(0);
                else
                    $averageCartValueBetweenCollection->push($averageCartValueForThatDay);
                $todaysDateCarbon->addDay(1);
            }
        }
        return view('admin.statistics.index')
            ->with('sumOrders', $sumOrders)
            ->with('sumCartValues', $sumCartValues)
            ->with('totalOrder', $totalOrder)
            ->with('countVisits', $countVisits)
            ->with('labelWeekCollection', implode(",", $labelWeekCollection->all()))
            ->with('labelMonthCollection', implode(",", $labelMonthCollection->all()))
            ->with('labelYearCollection', implode(",", $labelYearCollection->all()))
            ->with('labelBetweenCollection', implode(",", $labelBetweenCollection->all()))
            ->with('sumOrderValuesWeekCollection', implode(",", $sumOrderValuesWeekCollection->all()))
            ->with('visitorValueWeekCollection', implode(",", $visitorValueWeekCollection->all()))
            ->with('orderValueWeekCollection', implode(",", $orderValueWeekCollection->all()))
            ->with('averageCartValueWeekCollection', implode(",", $averageCartValueWeekCollection->all()))
            ->with('sumOrderValuesMonthCollection', implode(",", $sumOrderValuesMonthCollection->all()))
            ->with('visitorValueMonthCollection', implode(",", $visitorValueMonthCollection->all()))
            ->with('orderValueMonthCollection', implode(",", $orderValueMonthCollection->all()))
            ->with('averageCartValueMonthCollection', implode(",", $averageCartValueMonthCollection->all()))
            ->with('sumOrderValuesYearCollection', implode(",", $sumOrderValuesYearCollection->all()))
            ->with('visitorValueYearCollection', implode(",", $visitorValueYearCollection->all()))
            ->with('orderValueYearCollection', implode(",", $orderValueYearCollection->all()))
            ->with('averageCartValueYearCollection', implode(",", $averageCartValueYearCollection->all()))
            ->with('sumOrderValuesBetweenCollection', implode(",", $sumOrderValuesBetweenCollection->all()))
            ->with('visitorValueBetweenCollection', implode(",", $visitorValueBetweenCollection->all()))
            ->with('orderValueBetweenCollection', implode(",", $orderValueBetweenCollection->all()))
            ->with('averageCartValueBetweenCollection', implode(",", $averageCartValueBetweenCollection->all()));
    }
}