<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\EpicConnector;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Firebase\JWT\JWT;
use App\Helpers\Epic;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function index(Request $request) {

        // $token ="eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJ1cm46b2lkOjEuMi44NDAuMTE0MzUwLjEuMTMuMC4xLjcuMy42ODg4ODQuMTAwIiwiY2xpZW50X2lkIjoiMTUyYWJhN2EtYWUxNC00OTNjLWJhMmYtMGIyZjQwNDUzZjYzIiwiZXBpYy5lY2kiOiJ1cm46ZXBpYzpPcGVuLkVwaWMtY3VycmVudCIsImVwaWMubWV0YWRhdGEiOiI1VDB3cWJKREMtR0JKZWppYWhROEFzWXQ4S1k2cGZBbzNEeXRXN2JKVGpOT1ZxRXVxYzNZaDc3QkFGNVZYWlFZQ2NMeFpVbG91aHM2R1Ruekx3b2J3WFY4TEZWd2NJZXQ3Y01VbEE1Q2FXd0FZRXdiSDFEaUlsSERFRmpJT2t5RyIsImVwaWMudG9rZW50eXBlIjoiYWNjZXNzIiwiZXhwIjoxNzI0Njg0ODczLCJpYXQiOjE3MjQ2ODEyNzMsImlzcyI6InVybjpvaWQ6MS4yLjg0MC4xMTQzNTAuMS4xMy4wLjEuNy4zLjY4ODg4NC4xMDAiLCJqdGkiOiIwMGE4NDk4MC0wZWRhLTRmOTctODdkYy02ODVjNTJhYTdhNDciLCJuYmYiOjE3MjQ2ODEyNzMsInN1YiI6ImU2YXc2LVJKdUtPMm1icWpsZUt2Z1ZRMyJ9.Oe2k_o2w15Efaivj545fNI4F3LIyNyfoRnDhO_Xm_RUI6UO5J_C6-K-z_feK7Yyz9N9UgY7JpdlxPIlFl8_glUU1pn67T5Uk4191LEMPp9pqs2_XW6DhOnk7Vn7qsm5gadQihB5a29oPJa-l-EpGjgNcYU_VGyDJBfeRmf-GQgKoEl5wBYsgaSM0cfjQxSnQeGjasrTumKfHhdnTx3rWH8LCQdaxuzQnI-Yb4NzMwawS42rI96VR_jS8F5eqCMxfIdZsJHfsNTDkcjtlR9AWPZidcB56y-JC7ltGjOW2R6JihzbUMac8ushBJ1741m71OwRleeFLgUeRdQ8Deax6Wg";
        // //  $refresh_token = "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJ1cm46b2lkOjEuMi44NDAuMTE0MzUwLjEuMTMuMC4xLjcuMy42ODg4ODQuMTAwIiwiY2xpZW50X2lkIjoiMTUyYWJhN2EtYWUxNC00OTNjLWJhMmYtMGIyZjQwNDUzZjYzIiwiZXBpYy5lY2kiOiJ1cm46ZXBpYzpPcGVuLkVwaWMtY3VycmVudCIsImVwaWMubWV0YWRhdGEiOiJYM1hlYTFBOVlnY0JPcGtkbkRsdGNRcDNtTGlLVXczb3VPaHAwRm4tWGllZUNvZG9RWlh2T1QyQWU4dXdRNUU0TDd0VHR3V21yMll6WWJZSm0xT3VGNDBMYW5OQXA0X0pEbjlFU1RGRmJzbE1NWkd3ZFdvX3hIRHdtaW1sZk5qRSIsImVwaWMudG9rZW50eXBlIjoicmVmcmVzaCIsImlhdCI6MTcyNDY3Njg2OCwiaXNzIjoidXJuOm9pZDoxLjIuODQwLjExNDM1MC4xLjEzLjAuMS43LjMuNjg4ODg0LjEwMCIsImp0aSI6IjRjYmZkZDYyLWJlNzQtNDhmNC1iOWM0LWM2M2NiNzVjM2RmNiIsIm5iZiI6MTcyNDY3Njg2OCwic3ViIjoiZTZhdzYtUkp1S08ybWJxamxlS3ZnVlEzIn0.oOkNUl9P9yqUlbVDXYRyVJZkweZnGl44UrgBTC2Yk6KWsUHDqVLQBywQB_X4KIrlnuEZ_4rNMEfuZwpcMd1RtWxAkpvzEwPmv3BaLUmzE-n-6pNRQPflyVMKSGPvxyzWGnhKmGkorFeDqmC4W0HOryD4GKyo0RokIQBL8K5dHT7T0nlXcvovXD0l8w8Zfjf81oQ8VjEI8zuoQxzKZYaTCmIni5x00nL5OrF8Eq9zDaZWVM32xqRr7uYsqbhZO6btIvKOYSQBD2-triGGRP2x8q3EJ50SWz0kq-VnvRlyPwyJZ18scFS37wFQqoyJVScRP1fzaJUoBKXO4mqSsKnquw";
        // $epic = EpicConnector::where('user_id', auth()->user()->id)->first();
        // // $epic->access_token = $token;
        // // $epic->refresh_token = $refresh_token;
        // $epic->expires_on = date('Y-m-d H:i:s', strtotime('+55 minutes'));
        // $epic->save();
        $patients = Patient::latest();

        if($request->has('datetimes') && $request->datetimes != '') {
            [$startDateTime, $endDateTime] = explode(' - ', $request->datetimes);

            $start = Carbon::createFromFormat('Y/m/d h:i A', $startDateTime);
            $end = Carbon::createFromFormat('Y/m/d h:i A', $endDateTime);
            $patients = $patients->whereBetween('consultation_date', [$start, $end]);
        }

        if($request->has('search_patient') && $request->search_patient != '') {
            $key = $request->search_patient;
            $patients = $patients->where(function($query) use($key) {
                $query->where('first_name', 'LIKE', '%'.$key.'%')
                ->orWhere('last_name', 'LIKE', '%'.$key.'%');
            });
        }

        if($request->has('search_group') && $request->search_group != '') {
           
            $patients = $patients->where('group', $request->search_group);
        }

        $patients = $patients->orderBy('id', 'desc')->get();

        $epicConnector = EpicConnector::where('user_id', auth()->user()->id)->first();
        
        if($epicConnector) {
            if($epicConnector->expires_on > date('Y-m-d H:i:s')) {
                $epic_connected = 1;
            } else {
                $epic_connected = 0;
            }
        } else {
            $epic_connected = 0;
        }

        return view('patients.index', compact('patients', 'epic_connected'));
    }

    public function upload_patients(Request $request) {
        $the_file = $request->file('patient_list');
        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet        = $spreadsheet->getActiveSheet();
        $row_limit    = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range    = range( 2, $row_limit );
        $column_range = range( 'A', $column_limit );
        $startcount = 2;

        foreach ( $row_range as $index =>$row ) {
            $data_row = array();
            foreach(range('A', 'D') as $v){
                    
                array_push($data_row,$sheet->getCell( $v . $row )->getValue() );
                
            }

            if($data_row[0] == '')
            {
                break;
            }

            if($data_row[3] == 1) {
                $group = 'A';
            }
            if($data_row[3] == 2) {
                $group = 'B';
            }
            if($data_row[3] == 3) {
                $group = 'C';
            }
            if($data_row[3] == 4) {
                $group = 'D';
            }
            if($data_row[3] == 5) {
                $group = 'E';
            }
            if($data_row[3] == 6) {
                $group = 'F';
            }

            Patient::create([
                'first_name' => $data_row[0],
                'last_name' => $data_row[1],
                'dob' => date('Y-m-d', strtotime($data_row[2])),
                'group' => $group,
            ]);
        }

        return redirect(route('patients.index'));
    }

    public function epic_oauth(Request $request) {
        dd($request);
        if($request->has('code')) {
            $response = Epic::getAccessToken($request->code);
            dd($response);
            if(isset($response['access_token'])){
                $epic_user = EpicConnector::where('user_id', auth()->user()->id)->first();
                if($epic_user) {
                    $epic_user->access_token = $response['access_token']; 
                    $epic_user->refresh_token = $response['refresh_token'];
                    $epic_user->expires_on = date('Y-m-d H:i:s', strtotime('+50 minutes'));
                    $epic_user->save();
                } else {
                    EpicConnector::create([
                        'user_id' => auth()->user()->id,
                        'access_token' => $response['access_token'],
                        'refresh_token' => $response['refresh_token'],
                        'expires_on' => date('Y-m-d H:i:s', strtotime('+50 minutes'))
                    ]);
                }
            }

        }
        return redirect(route('patients.index'));
    }

    public function create_epic_oauth() {
        // $this->checkBackendAuth();
        $epicDetails = EpicConnector::where('user_id', auth()->user()->id)->first();

        // if($epicDetails) {
        //     Epic::updateAccessToken($epicDetails);
        //     return redirect(route('patients.index'));
        // } else {
            $base_url = "https://fhir.epic.com/interconnect-fhir-oauth/oauth2/authorize";
            $params = [
                'response_type' => 'code',
                // 'redirect_uri' => 'https://ebd9-2409-40d1-3-480a-1449-88f2-a6cd-3cfe.ngrok-free.app',
                'redirect_uri' => 'http://127.0.0.1:8000',
                'scope' => 'Openid Connect id_tokens',
                'state' => 'xyz',
                // 'client_id' => '85fa0b7e-2e7f-4aed-8540-770a15b86874'
                'client_id' => '152aba7a-ae14-493c-ba2f-0b2f40453f63'
            ];
            $query_string = http_build_query($params);
            $full_url = $base_url . '?' . $query_string;
            return redirect($full_url);
        // }
    }

    public function getEpicPatient($id) {
        $epicPatient = Epic::getPatientDetails($id);
        
        return view('patients.epic_patient', compact('epicPatient'));
    }

    public function patientProcedures($id) {
        $patientProcedures = Epic::getPatientProcedures($id);
        if(isset($patientProcedures['entry'])) {
            $procedure = $patientProcedures['entry'][0];
        } else {
            $procedure = null;
        }
        $patient_id = $id;  
        return view('patients.epic_patient_procedures', compact('procedure' , 'patient_id'));
    }

    public function getProcedure($id) {
        $procedure = Epic::getProcedure($id);
        dd($procedure);
    }

    public function checkBackendAuth() {
        $privateKey = file_get_contents(__DIR__.'/private-key.pem');
        
        $token = [
            'iss' => '85fa0b7e-2e7f-4aed-8540-770a15b86874',  // Your client ID
            'aud' => 'https://fhir.epic.com/interconnect-fhir-oauth/oauth2/token',  // The token endpoint URL
            'jti' => '3fca7b08-e5a1-4476-9e4b-4e17f0ad7d1d',  // A unique identifier for the token
            // 'jti' => bin2hex(random_bytes(16)),  // A unique identifier for the token
            'nbf' => time() + 300,  // Token expiration time (e.g., 5 minutes from now)
            'exp' => time() + 300,  // Token expiration time (e.g., 5 minutes from now)
            'iat' => time() + 300,  // Token expiration time (e.g., 5 minutes from now)
            'sub' => '85fa0b7e-2e7f-4aed-8540-770a15b86874',  // Your client ID
        ];

        $jwt = JWT::encode($token, $privateKey, 'RS256');
        dd($jwt);
        Epic::connectToBackendSystem($jwt);
    }
}
