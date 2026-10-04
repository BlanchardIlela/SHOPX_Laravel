@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Kyc Requests</h3>
                <div class="card-actions">
                    <a href="#" class="btn btn-primary btn-3">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-2">
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Add new
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Paweł Kuna</td>
                                <td class="text-secondary">UI Designer, Training</td>
                                <td class="text-secondary"><a href="#"
                                        class="text-reset">paweluna@howstuffworks.com</a></td>
                                <td class="text-secondary">User</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Jeffie Lewzey</td>
                                <td class="text-secondary">Chemical Engineer, Support</td>
                                <td class="text-secondary"><a href="#" class="text-reset">jlewzey1@seesaa.net</a></td>
                                <td class="text-secondary">User</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Mallory Hulme</td>
                                <td class="text-secondary">Geologist IV, Support</td>
                                <td class="text-secondary"><a href="#" class="text-reset">mhulme2@domainmarket.com</a>
                                </td>
                                <td class="text-secondary">User</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Dunn Slane</td>
                                <td class="text-secondary">Research Nurse, Sales</td>
                                <td class="text-secondary"><a href="#" class="text-reset">dslane3@epa.gov</a></td>
                                <td class="text-secondary">Owner</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Emmy Levet</td>
                                <td class="text-secondary">VP Product Management, Accounting</td>
                                <td class="text-secondary"><a href="#" class="text-reset">elevet4@senate.gov</a></td>
                                <td class="text-secondary">User</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Maryjo Lebarree</td>
                                <td class="text-secondary">Civil Engineer, Product Management</td>
                                <td class="text-secondary"><a href="#" class="text-reset">mlebarree5@unc.edu</a></td>
                                <td class="text-secondary">User</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Egan Poetz</td>
                                <td class="text-secondary">Research Nurse, Engineering</td>
                                <td class="text-secondary"><a href="#" class="text-reset">epoetz6@free.fr</a></td>
                                <td class="text-secondary">Admin</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Kellie Skingley</td>
                                <td class="text-secondary">Teacher, Services</td>
                                <td class="text-secondary"><a href="#" class="text-reset">kskingley7@columbia.edu</a>
                                </td>
                                <td class="text-secondary">Owner</td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
