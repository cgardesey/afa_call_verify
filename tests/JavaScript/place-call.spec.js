import {mount} from 'vue-test-utils';
import expect from 'expect';
import PlaceCall from "../../resources/js/components/PlaceCall";
describe('PlaceCall', () => {
    it ('says Call Verify', () => {
        let wrapper = mount(PlaceCall);

        expect(wrapper.html).toContain('Call Verify');
    });
});
