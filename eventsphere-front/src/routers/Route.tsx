import { createBrowserRouter } from "react-router-dom";
import HomePage from "../components/home/pages/HomePage.tsx";
import UserTemplate from "../templates/user/UserTemplate.tsx";
import EventsTemplate from "../templates/events/EventsTemplate.tsx";
import MeetupPage from "../components/meetups/pages/MeetupPage.tsx";
import RegisterOrganism from "../components/authentification/components/register/organism/RegisterOrganism.tsx";
import RegisterFormUser from "../components/authentification/components/register/user/RegisterFormUser.tsx";
import LoginPage from "../components/authentification/pages/loginpage/LoginPage.tsx";
import RegisterPage from "../components/authentification/pages/registerpage/RegisterPage.tsx";
import LoginFormUser from "../components/authentification/components/login/user/LoginFormUser.tsx";
import LoginFormOrganism from "../components/authentification/components/login/organism/LoginFormOrganism.tsx";

export const routes = createBrowserRouter([
  {
    path: "/",
    element: <UserTemplate />,
    children: [
      {
        path: "/",
        element: <HomePage />
      },
      {
        path: "/login",
        element: <LoginPage />,
        children: [
          {
            index: true,
            element: <LoginFormUser />
          },
          {
            path: "user",
            element: <LoginFormUser />
          },
          {
            path: "organism",
            element: <LoginFormOrganism />
          }
        ]
      },
      {
        path: "/register",
        element: <RegisterPage />,
        children: [
          {
            index: true,
            element: <RegisterFormUser />
          },
          {
            path: "user",
            element: <RegisterFormUser/>
          },
          {
            path: "organism",
            element: <RegisterOrganism />
          }
        ]
      }
    ],
  },
  {
    path: "/meetups",
    element: <EventsTemplate/>,
    children: [
      {
        index: true,
        element: <MeetupPage/>
      }
    ]
  }
]);