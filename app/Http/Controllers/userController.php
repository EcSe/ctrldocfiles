<?php

namespace App\Http\Controllers;

use App\Models\casefilesModel;
use App\Models\mainDocumentModel;
use App\Models\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function login(Request $request)
    {
        $id = $request->input('id');
        $password = $request->input('password');
        if (DB::table('tb_users')->count() === 0) {
            if ($id === 'esalinas' && $password === '08121988') {
                $userMaster = new userModel();
                $userMaster->name = 'elvin salinas espinoza ';
                $userMaster->email = 'spamecse@icloud.com';
                $userMaster->description = 'Administrador';
                $userMaster->login = 'esalinas';
                $userMaster->password = password_hash('08121988', PASSWORD_DEFAULT);
                $userMaster->type_level = 1;
                $userMaster->account_state = 1;
                $userMaster->save();

                return view('main', array(
                    session(['user' => $userMaster]),
                ));

            } else {
                return redirect()->route('login')->with(array(
                    'aviso' => 'El usuario y/o contraseña son incorrectos',
                ));
            }
        } else {
            $userDB = userModel::where([
                ['login', $id],
                ['account_state', 1],
            ])->first();
            if (count((array) $userDB) > 0 && password_verify($password, $userDB->password)) {
                return view('main   ', array(
                    session(['user' => $userDB]),
                ));
            } else {
                return redirect()->route('login')->with(array(
                    'aviso' => 'El usuario y/o contraseña son incorrectos',
                ));
            }
        }
    }

    public function disco()
    {
        $espacioLibre = disk_free_space('/');
        $espacioTotal = disk_total_space('/');
        $percent = ($espacioLibre / $espacioTotal) * 100;

        return response()->json($percent);
    }

    public function agregar(Request $request)
    {
        $user = new userModel();
        $user->code = $request->input('code');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->description = $request->input('description');
        $user->login = $request->input('login');
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $user->keyaccess = $request->input('keyaccess');
        $user->type_level = $request->input('typeLevel');
        $user->account_state = $request->input('accountState');
        $user->save();
        return response()->json('El usuario ' . $user->login . ' ha sido agregado correctamente');
    }

    public function destroy($id)
    {
        $documents = mainDocumentModel::where('user_upload_id', $id)->first();
        $casefiles = casefilesModel::where('start_user_id', $id)->first();
        if ($casefiles) {
            return response()->json('Error: El usuario no se puede eliminar, tiene asignado el
                                    expediente con descripcion: ' . $casefiles->description, 400);
        } else if ($documents) {
            return response()->json('Error: El usuario no se puede eliminar, tiene asignado el
                                    documento con descripcion: ' . $documents->description, 400);
        } else {
            $usuario = userModel::where('id', $id)->first();
            if ($usuario) {
                $usuario->delete();
                return response()->json('El usuario ha sido eliminado con exito', 200);
            } else {
                return response()->json('Ha ocurrido un error', 500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $userUpdate = userModel::where('id', $id)->first();
        $userUpdate->code = $request->input('code');
        $userUpdate->name = $request->input('name');
        $userUpdate->email = $request->input('email');
        $userUpdate->description = $request->input('description');
        $userUpdate->login = $request->input('login');
        $userUpdate->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $userUpdate->keyaccess = $request->input('keyaccess');
        $userUpdate->type_level = $request->input('typeLevel');
        $userUpdate->account_state = $request->input('accountState');
        $userUpdate->save();

        return response()->json('El usuario ' . $userUpdate->login . ' ha sido actualizado');
    }

    public function show($id)
    {
        $usr = userModel::with(['type_level', 'account_state'])->where('id', $id)->first();
        if ($usr) {
            return response()->json($usr);
        } else {
            return response()->json('Ha ocurrido un error');
        }
    }
    public function listPaginate()
    {
        $userNow = session('user');
        $users = userModel::with(['account_state'])->orderBy('id','desc')->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'listUserPaginate' => $users]);
    }
    public function listar()
    {
        $users = userModel::with(['account_state'])->orderBy('id','desc')->get();
        return response()->json($users);
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }

    public function search(Request $request)
    {
        $userNow = session('user');
        $login = $request->input('srchLogin', null);
        $name = $request->input('srchName', null);
        $email = $request->input('srchEmail', null);

        $users = DB::table('tb_users')
            ->when($login, function ($query) use ($login) {
                return $query->orWhere('login', 'like', '%' . $login . '%');
            })
            ->when($name, function ($query) use ($name) {
                return $query->orWhere('name', 'like', '%' . $name . '%');
            })
            ->when($email, function ($query) use ($email) {
                return $query->orWhere('email', 'like', '%' . $email . '%');
            })
            ->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'users' => $users]);
    }
}
