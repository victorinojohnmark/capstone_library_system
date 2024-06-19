<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

use App\System\Helper;

use App\Models\Section;
use App\Models\Adviser;
use App\Models\Department;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],

            'lastname' => ['required'],
            'firstname' => ['required'],
            // 'middle_initial' => ['nullable'],
            'email' => ['required', 'unique:users','email'],
            'password' => ['required','confirmed','min:6'],
            'type' => ['required'],
            'lrn' => ['required_if:type,Student','min:12',"max:12", 'unique:users,lrn'],
            'grade_no' => ['required_if:type,Student','integer'],
            'section_id' => ['required_if:type,Student'],
            'adviser_id' => ['required_if:type,Student'],
            'department_id' => ['required_if:type,Faculty'],
            'employee_no' => ['required_if:type,Faculty'],
            
            'image_filename' => ['sometimes','mimes:jpg,jpeg,png','max:5120'],
        ], [
            'lrn.min' => 'LRN must be 12 digits.',
            'lrn.max' => 'LRN must be 12 digits.',
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all(), $request)));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    protected function create(array $data, Request $request)
    {
        unset($data['image_filename']);

        // dd($data);

        $user = User::create([
            // 'name' => $data['name'],
            // 'email' => $data['email'],
            // 'password' => Hash::make($data['password']),

            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            // 'middle_initial' => $data['middle_initial'] ?? null,
            'email' => $data['email'],
            'password' => $data['password'],
            'lrn' => $data['lrn'] ?? null,
            'grade_no' => $data['grade_no'] ?? null,
            'section_id' => $data['section_id'] ?? null,
            'adviser_id' => $data['adviser_id'] ?? null,
            'type' => $data['type'],
            'department_id' => $data['department_id'] ?? null,
            'employee_no' => $data['employee_no'] ?? null
        ]);

        if($request->hasFile('image_filename')) {
            $file = $request->file('image_filename');
            $fileName = $file->getClientOriginalName();
            $fileExtension = $file->guessExtension();
            $customFileName = uniqid() . now()->timestamp . '.' . $fileExtension;

            $file->storeAs('/public/profile_picture/', $customFileName);

            //update image filename
            $user->image_filename = $customFileName;
            $user->update();
        }

        return $user;
    }

    public function showRegistrationForm()
    {
        return view('auth.register', [
            'grades' => Helper::getDropDownJson('grades.json'),
            'sections' => Section::orderBy('section_name')->get(),
            'advisers' => Adviser::latest()->get(),
            'types' => Helper::getDropDownJson('user_types.json'),
            'departments' => Department::orderBy('department_name')->get(),
        ]);
    }
}
