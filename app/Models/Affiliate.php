<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class Affiliate extends Model
{
    use HasFactory;

    protected $table ='affiliates';
    protected $primaryKey = 'idAffiliated';
    public $timestamps = false;

    protected $fillable = [
        'SSN',
        'Name',
        'LastName',
        'AlternativePhone',
        'WorkPhone',
        'DateBirth',
        'Email',
        'confirmedEmail',
        'Address',
        'Country',
        'State',
        'City',
        'ZipCode',
        'Phone',
        'Latitude',
        'Longitude',
        'firstBuy',
        'StatusAff'
    ];

    public function webSiteUser(): HasOne{
        return $this->hasOne(Website::class);
    }

	/** ver tablas de una bd */
	// Obtención de la lista de tablas
	public function verTablas(){
		$tables = DB::select('SHOW TABLES');

		$tables = DB::select('
					SELECT table_name, column_name
					FROM information_schema.columns
					WHERE table_schema = ?
					', ['BesanaGlobalNew']);

		return $tables;
	}

	/** bloque de puntos obtenidos en la compra en el web site de usuarios clientes,
	 *  solo usando el nombre de referencia. */
	public function getTotalPoints($id) {
		
		if ($id == 1) {
			$oficinaQuery = DB::table('sales')
			->join('detailsale', 'sales.idSale', '=', 'detailsale.id_sale')
			->join('affiliates', 'sales.idAffiliated', '=', 'affiliates.idAffiliated')
			->join('websites', 'affiliates.idAffiliated', '=', 'websites.idAffiliated')
			->join('products', 'sales.idProd', '=', 'products.idProd')
			->where('sales.webShop', '=', 'website')
			->where('webSites.webSite', '=', 'oficina')
			->where('affiliates.idAffiliated', '=', $id)
			->select(DB::raw('sum(products.puntos) as puntosOficina'));

			$oficina = $oficinaQuery->first()->puntosOficina;

			$webQuery = DB::table('sales')
			->join('detailsale', 'sales.idSale', '=', 'detailsale.id_sale')
			->join('affiliates', 'sales.idAffiliated', '=', 'affiliates.idAffiliated')
			->join('websites', 'affiliates.idAffiliated', '=', 'websites.idAffiliated')
			->join('products', 'sales.idProd', '=', 'products.idProd')
			->where('sales.webShop', '=', 'website')
			->where('webSites.webSite', '=', 'https://www.besanaglobal.com/BesanaMaster')
			->where('affiliates.idAffiliated', '=', $id)
			->select(DB::raw('SUM(detailsale.cantidad * products.puntosWebsite) AS puntosWeb'))
			->get();

			$web = $webQuery->first()->puntosWeb;
			
			$result = $oficina + $web;
			return $result;
		}

		$query = DB::table('sales')
        ->join('detailsale', 'sales.idSale', '=', 'detailsale.id_sale')
        ->join('affiliates', 'sales.idAffiliated', '=', 'affiliates.idAffiliated')
        ->join('websites', 'affiliates.idAffiliated', '=', 'websites.idAffiliated')
        ->join('products', 'sales.idProd', '=', 'products.idProd')
        ->where('sales.webShop', '=', 'website')
        ->where('websites.webSite', '<>', 'oficina')
        ->where('affiliates.idAffiliated', '=', $id)
        ->select(DB::raw('SUM(detailsale.cantidad * products.puntosWebsite) AS puntosWeb'))
		->get();

		return $query->first() == null ? 0 : $query->first()->puntosWeb;
		
	}

	/** bloque de puntos obtenidos en la compra en el web site de usuarios que son socios promotores, 
	* solo usando el nombre de referencia. */
	public function getTotalPointsPromoters($id) {

		$query = DB::table('affiliates')
		->join('ranks', 'affiliates.idRank', '=', 'ranks.idRank')
		->join('arbol', 'affiliates.idAffiliated', '=', 'arbol.idSon')
		->join('Sales', 'affiliates.idAffiliated', '=', 'Sales.idAffiliated')
		->join('webSites', 'Sales.idWebsite', '=', 'webSites.idWebsite')
		->join('products', 'Sales.idProd', '=', 'products.idProd')
		->where('ranks.RankName', '=', 'SOCIO PROMOTOR')
		->where('arbol.idFhater', $id)
		->groupBy('arbol.idFhater', 'webSites.webSite')
		->select('arbol.idFhater', 'webSites.webSite', DB::raw('sum(products.puntosWebsite) as puntosWeb'))
		->get();

		return $query->first() == null? 0 : $query->first()->puntosWeb;

	}

	/** bloque de puntos obtenidos en la compra en la oficina de usuarios que son socios activos, 
	* solo usando el nombre de referencia. */
	public function getTotalPointsActive($id) {

		$query = DB::table('affiliates')
		->join('ranks', 'affiliates.idRank', '=', 'ranks.idRank')
		->join('arbol', 'affiliates.idAffiliated', '=', 'arbol.idSon')
		->join('Sales', 'affiliates.idAffiliated', '=', 'Sales.idAffiliated')
		->join('webSites', 'Sales.idWebsite', '=', 'webSites.idWebsite')
		->join('products', 'Sales.idProd', '=', 'products.idProd')
		->where('ranks.RankName', '<>', 'SOCIO PROMOTOR')
		->where('arbol.idFhater', $id)
		->groupBy('arbol.idFhater', 'arbol.idSon', 'webSites.webSite', 'affiliates.Name', 'ranks.RankName')
		->select('arbol.idFhater', 'arbol.idSon', 'webSites.webSite', 'affiliates.Name', 'ranks.RankName', DB::raw('sum(products.puntos) as puntosOficina'))
		->get();

		return $query->first() == null? 0 : $query->first()->puntosOficina;

	}

	public function getActivePromoters($id){
		$query = DB::table('affiliates')
		->select('affiliates.Name', 'affiliates.Email', 'affiliates.Phone', DB::raw('SUM(products.puntosWebsite) as volumen'), 'users.active')
		->join('users', 'affiliates.idAffiliated', '=', 'users.idAffiliated')
		->join('ranks', 'affiliates.idRank', '=', 'ranks.idRank')
		->join('arbol', 'affiliates.idAffiliated', '=', 'arbol.idSon')
		->join('Sales', 'affiliates.idAffiliated', '=', 'Sales.idAffiliated')
		->join('webSites', 'webSites.idWebsite', '=', 'Sales.idWebsite')
		->join('products', 'products.idProd', '=', 'Sales.idProd')
		->where('ranks.RankName', '=', 'SOCIO PROMOTOR')
		->where('arbol.idFhater', '=', $id)
		->groupBy('affiliates.Name', 'affiliates.Email', 'affiliates.Phone', 'users.active')
		->get();

		return $query;
	}

	/** bloque de puntos por clientes */
	public function getClientPointsByAffiliated($id)
    {
        $query = DB::table('sales')
        ->join('detailsale', 'sales.idSale', '=', 'detailsale.id_sale')
        ->join('affiliates', 'sales.idAffiliated', '=', 'affiliates.idAffiliated')
        ->join('websites', 'affiliates.idAffiliated', '=', 'websites.idAffiliated')
        ->join('products', 'sales.idProd', '=', 'products.idProd')
        ->where('sales.webShop', '=', 'website')
        ->where('websites.webSite', '<>', 'oficina')
        ->where('affiliates.idAffiliated', '=', $id)
        ->groupBy('affiliates.idAffiliated', 'affiliates.Name', 'websites.webSite', 'sales.WebNameClient', 'sales.WebEmailClient')
        ->select('affiliates.idAffiliated', 'affiliates.Name', 'websites.webSite', DB::raw('SUM(detailsale.cantidad * products.puntosWebsite) AS puntosWeb'), 'sales.WebNameClient', 'sales.WebEmailClient')
        ->get();
    
        return $query;
    }

	
	/** bloque de hijos promotores activos */
	// public function getTotalChildPromoters($id) {
	// 	$query = DB::table('affiliates')
	// 	->select('affiliates.Name as Name', 'affiliates.idAffiliated as idSon')
	// 	->join('users', 'users.idAffiliated', '=', 'affiliates.idAffiliated')
	// 	->join('arbol', 'arbol.idSon', '=', 'affiliates.idAffiliated')
	// 	->where('arbol.idFhater', $id)
	// 	->where('users.active', 1)
	// 	->get();

	// 	$names = array();
	// 	foreach ($query as $row) {
	// 			$names[$row->idSon] = $row->Name;
	// 	}

	// 	return $names;
	// }

	/** bloque de hijos de hijos promotores activos */
	// public function getAllGrandChildPromoters($id) {
	// 	$query = DB::table('affiliates')
	// 		->select('affiliates.Name as Name', 'affiliates.idAffiliated as id')
	// 		->join('users', 'users.idAffiliated', '=', 'affiliates.idAffiliated')
	// 		->join('arbol', 'arbol.idSon', '=', 'affiliates.idAffiliated')
	// 		->where('arbol.idFhater', $id)
	// 		->where('users.active', 1)
	// 		->get();
	
	// 	$names = array();
	// 	foreach ($query as $row) {
	// 		$names[$row->id] = $row->Name;
	// 	}
	
	// 	$results = array();
	// 	foreach ($names as $key => $name) {
	// 		$query2 = DB::table('affiliates')
	// 			->select('affiliates.Name as Name', 'affiliates.idAffiliated as id')
	// 			->join('users', 'users.idAffiliated', '=', 'affiliates.idAffiliated')
	// 			->join('arbol', 'arbol.idSon', '=', 'affiliates.idAffiliated')
	// 			->where('arbol.idFhater', $key)
	// 			->where('users.active', 1)
	// 			->get();
	
	// 		foreach ($query2 as $row) {
	// 			$results[$key][$row->id] = $row->Name;
	// 		}
	// 	}
	
	// 	return $results;
	// }

	/** bloque de hijos de hijos promotores no activos */
	// public function getAllGrandChildNotPromoters($id) {
	// 	$query = DB::table('affiliates')
	// 		->select('affiliates.Name as Name', 'affiliates.idAffiliated as id')
	// 		->join('users', 'users.idAffiliated', '=', 'affiliates.idAffiliated')
	// 		->join('arbol', 'arbol.idSon', '=', 'affiliates.idAffiliated')
	// 		->where('arbol.idFhater', $id)
	// 		->where('users.active', 1)
	// 		->get();
	
	// 	$names = array();
	// 	foreach ($query as $row) {
	// 		$names[$row->id] = $row->Name;
	// 	}
	
	// 	$results = array();
	// 	foreach ($names as $key => $name) {
	// 		$query2 = DB::table('affiliates')
	// 			->select('affiliates.Name as Name', 'affiliates.idAffiliated as id')
	// 			->join('users', 'users.idAffiliated', '=', 'affiliates.idAffiliated')
	// 			->join('arbol', 'arbol.idSon', '=', 'affiliates.idAffiliated')
	// 			->where('arbol.idFhater', $key)
	// 			->where('users.active', 0)
	// 			->get();
	
	// 		foreach ($query2 as $row) {
	// 			$results[$key][$row->id] = $row->Name;
	// 		}
	// 	}
	
	// 	return $results;
	// }

}
