type registerUserData = {
  lastname: string;
  firstname: string;
  nickname: string;
  email: string;
  address: string;
  address_two: string;
  city: string;
  postal_code: string;
  phone: string;
  password: string;
};

type loginUserData = {
  email: string;
  password: string;
};

type registerOrganismData = {
  personal_lastname: string;
  personal_firstname: string;
  personal_email: string;
  personal_address: string;
  personal_address_two: string;
  personal_city: string;
  personal_region: string;
  personal_phone: string;
  password: string;
  organization_name: string;
  organization_email: string;
  organization_phone: string;
  organization_address: string;
  organization_address_two: string;
  organization_city: string;
  organization_postal_code: string;
  organization_region: string;
  organization_type: string;
}

type loginOrganismData = {
  email: string;
  password: string;
}


export type { loginUserData, registerUserData, loginOrganismData, registerOrganismData};
