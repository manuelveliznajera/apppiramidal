<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\User;
use App\Models\WalletMonth;
use App\Models\WalletWeek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use DB;



class PageController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview1()
    {
        
        $idLog=Auth()->user()->idUser;
        $id=User::where('idUser',$idLog)->first();
        $afiliado=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();

        $walletWeek=WalletWeek::where(
            'id_user','=',  $id->idAffiliated,
        )->get();
    
        $walletMonth=WalletMonth::where([
            ['id_user', '=', $id->idAffiliated],
        ])->get();

        /** ver tablas de la bd */
        // $tablas = $afiliado->verTablas();
        // dd($tablas);

        /** bloque de puntos obtenidos en la compra en el web site y en la oficina de usuarios clientes, 
         * solo usando el nombre de referencia. */
         $totalPoints = $afiliado->getTotalGeneralPointsByClientsInTheWebsiteAndOffice($id->idUser);
        //  dd($totalPoints);

        /** bloque de puntos obtenidos en la compra en el web site de usuarios que son socios promotores, 
         * solo usando el nombre de referencia. */
         $totalPointsPromoters = $afiliado->getTotalPointsByPromotersInTheWebsiteBuy($id->idUser);
        // dd($totalPointsPromoters);

        /** bloque de puntos obtenidos en la compra en la oficina de usuarios que son socios activos, 
         * solo usando el nombre de referencia. */
        $totalPointsActive = $afiliado->getTotalPointsByActivePartners($id->idUser);
        // dd($totalPointsActive);

        return view('pages/dashboard-overview-1',compact('afiliado','walletWeek','walletMonth', 'totalPoints', 'totalPointsPromoters', 'totalPointsActive'));
    }

    public function solicitaWeek(Request $request){
        $wallet=WalletWeek::findOrFail($request->id);
        $wallet->estado='solicitado';
        $wallet->save();
        session()->flash('success', '¡La información se ha procesado correctamente!');

        // Regresar a la misma vista con el mensaje de éxito
        return back();
    }

    public function solicitaMonth(Request $request){
        $wallet=WalletMonth::findOrFail($request->id);
        $wallet->estado='solicitado';
        $wallet->save();
        session()->flash('success', '¡Se ha solicitado el pago Mensual!');
        return back();

    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview2()
    {
        return view('pages/dashboard-overview-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview3()
    {
        return view('pages/dashboard-overview-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboardOverview4()
    {
        return view('pages/dashboard-overview-4');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        return view('pages/inbox');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        return view('pages/categories');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct()
    {
        return view('pages/add-product');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productList()
    {
        return view('pages/product-list');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function productGrid()
    {
        return view('pages/product-grid');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transactionList()
    {
        return view('pages/transaction-list');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transactionDetail()
    {
        return view('pages/transaction-detail');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sellerList()
    {
        return view('pages/seller-list');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sellerDetail()
    {
        return view('pages/seller-detail');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reviews()
    {
        return view('pages/reviews');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fileManager()
    {
        return view('pages/file-manager');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pointOfSale()
    {
        return view('pages/point-of-sale');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chat()
    {
        return view('pages/chat');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        return view('pages/post');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        return view('pages/calendar');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crudDataList()
    {
        dd('crud');
        
        return view('pages/crud-data-list');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crudForm()
    {
        return view('pages/crud-form');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersLayout1()
    {
        return view('pages/users-layout-1');
    }

    public function activepartners()
    {
        $idLog=Auth()->user()->idUser;
        $id=User::where('idUser',$idLog)->first();
        $afiliado=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();

        /** bloque de puntos obtenidos en la compra en el web site y en la oficina de usuarios clientes, 
         * solo usando el nombre de referencia. */
        $totalPoints = $afiliado->getTotalGeneralPointsByClientsInTheWebsiteAndOffice($id->idUser);
        //  dd($totalPoints);

        /** bloque de puntos obtenidos en la compra en el web site de usuarios que son socios promotores, 
         * solo usando el nombre de referencia. */
         $totalPointsPromoters = $afiliado->getTotalPointsByPromotersInTheWebsiteBuy($id->idUser);
        // dd($totalPointsPromoters);

        /** bloque de puntos obtenidos en la compra en la oficina de usuarios que son socios activos, 
         * solo usando el nombre de referencia. */
        $totalPointsActive = $afiliado->getTotalPointsByActivePartners($id->idUser);
        // dd($totalPointsActive);

        $activePartners = $afiliado->getActivePartnersByAffiliated($id->idUser);
        // dd($activePartners); 
        
        return view('pages.active-partners', compact('totalPoints', 'totalPointsPromoters', 'totalPointsActive', 'activePartners'));
    }


    public function sociospromotor()
    {
        $idLog=Auth()->user()->idUser;
        $id=User::where('idUser',$idLog)->first();
        $afiliado=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();

        /** bloque de puntos obtenidos en la compra en el web site y en la oficina de usuarios clientes, 
         * solo usando el nombre de referencia. */
        $totalPoints = $afiliado->getTotalGeneralPointsByClientsInTheWebsiteAndOffice($id->idUser);
        //  dd($totalPoints);

        /** bloque de puntos obtenidos en la compra en el web site de usuarios que son socios promotores, 
         * solo usando el nombre de referencia. */
         $totalPointsPromoters = $afiliado->getTotalPointsByPromotersInTheWebsiteBuy($id->idUser);
        // dd($totalPointsPromoters);

        /** bloque de puntos obtenidos en la compra en la oficina de usuarios que son socios activos, 
         * solo usando el nombre de referencia. */
        $totalPointsActive = $afiliado->getTotalPointsByActivePartners($id->idUser);
        // dd($totalPointsActive);

        $activePromoters = $afiliado->getActivePromotersByAffiliated($id->idUser);
        // dd($activePromoters); 
        

        return view('pages.sociospromotor', compact('totalPoints', 'totalPointsPromoters', 'totalPointsActive', 'activePromoters'));
    }
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersLayout2()
    {
        $idLog=Auth()->user()->idUser;
        $id=User::where('idUser',$idLog)->first();
        $afiliado=Affiliate::where('idAffiliated',Auth()->user()->idUser)->first();

        $clients = $afiliado->getClientByAffiliatedInTheWebsite($id->idUser);
        // dd($clients);

        $office = $afiliado->getBuyAffiliatedInTheOffice(2);
        // dd($office);

        return view('pages/users-layout-2', compact('clients', 'office'));
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersLayout3()
    {
        return view('pages/users-layout-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileOverview1()
    {
        return view('pages/profile-overview-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileOverview2()
    {
        return view('pages/profile-overview-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileOverview3()
    {
        return view('pages/profile-overview-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wizardLayout1()
    {
        return view('pages/wizard-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wizardLayout2()
    {
        return view('pages/wizard-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wizardLayout3()
    {
        return view('pages/wizard-layout-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blogLayout1()
    {
        return view('pages/blog-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blogLayout2()
    {
        return view('pages/blog-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function blogLayout3()
    {
        return view('pages/blog-layout-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pricingLayout1()
    {
        return view('pages/pricing-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pricingLayout2()
    {
        return view('pages/pricing-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoiceLayout1()
    {
        return view('pages/invoice-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invoiceLayout2()
    {
        return view('pages/invoice-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faqLayout1()
    {
        return view('pages/faq-layout-1');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faqLayout2()
    {
        return view('pages/faq-layout-2');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function faqLayout3()
    {
        return view('pages/faq-layout-3');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('pages/login');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('pages/register');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function errorPage()
    {
        return view('pages/error-page');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile()
    {
    //    $data=json_decode(json_encode(\Illuminate\Support\Facades\DB::select("CALL SpAffiliated ('NEW',0,'{$datos['SSN']}')")),true);
        
        return view('pages/update-profile');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        return view('login/forget-password');
    }

    public function sendEmailPassword(Request $request){
        $e=$request->email;
        $email = Affiliate::where('Email',$e)->first();
        if ($email) {
            $password = Str::random(10);
            $user = User::where('idAffiliated',$email->idAffiliated)->first();
            $name=$user->userName;
            $user->Password = Hash::make($password);
            $user->save();
            $datos=['Email'=>$request->email,'Name'=>$name, 'password'=>$password];
            // dd($datos);
            Mail::send('livewire.register.sendEmailPassword',$datos, function($message) use ($datos) {
                $message->to($datos['Email'], $datos['Name'])->subject('Nueva Contraseña-Besana');
            });
            
        }else{
            return redirect()
            ->back()
            ->withErrors([
                'message' => 'Email no Existe!',
            ]);
        }
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regularTable()
    {
        return view('pages/regular-table');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tabulator()
    {
        return view('pages/tabulator');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function modal()
    {
        return view('pages/modal');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function slideOver()
    {
        return view('pages/slide-over');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notification()
    {
        return view('pages/notification');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tab()
    {
        return view('pages/tab');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accordion()
    {
        return view('pages/accordion');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function button()
    {
        return view('pages/button');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function alert()
    {
        return view('pages/alert');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function progressBar()
    {
        return view('pages/progress-bar');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tooltip()
    {
        return view('pages/tooltip');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dropdown()
    {
        return view('pages/dropdown');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function typography()
    {
        return view('pages/typography');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function icon()
    {
        return view('pages/icon');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadingIcon()
    {
        return view('pages/loading-icon');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regularForm()
    {
        return view('pages/regular-form');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function datepicker()
    {
        return view('pages/datepicker');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tomSelect()
    {
        return view('pages/tom-select');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        return view('pages/file-upload');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorClassic()
    {
        return view('pages/wysiwyg-editor-classic');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorInline()
    {
        return view('pages/wysiwyg-editor-inline');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorBalloon()
    {
        return view('pages/wysiwyg-editor-balloon');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorBalloonBlock()
    {
        return view('pages/wysiwyg-editor-balloon-block');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wysiwygEditorDocument()
    {
        return view('pages/wysiwyg-editor-document');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validation()
    {
        return view('pages/validation');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chart()
    {
        return view('pages/chart');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function slider()
    {
        return view('pages/slider');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function imageZoom()
    {
        return view('pages/image-zoom');
    }
}
