import Input from "../input/Input.tsx";

const Header = () => {
    return (
        <header>
            <div>
                <h1>Event Sphere la plateforme de votre événement</h1>
                <Input type={"text"} name={"search"} id={"search-header"} />
            </div>
        </header>
    );
};

export default Header;
